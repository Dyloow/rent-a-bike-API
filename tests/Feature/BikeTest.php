<?php

use App\Models\{Bike, User};
use function Pest\Laravel\{delete, get, post, put};

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('can list bikes', function () {
    Bike::factory()->count(5)->create();

    $response = get('/api/bikes?pagination[current]=1&pagination[pageSize]=15');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'model', 'brand', 'year'],
            ],
        ]);
});

test('can show a bike', function () {
    $bike = Bike::factory()->create();

    $response = get("/api/bikes/{$bike->id}");

    $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $bike->id,
                'model' => $bike->model,
                'brand' => $bike->brand,
                'year' => $bike->year,
            ],
        ]);
});

test('can create a bike', function () {
    $bikeData = [
        'model' => 'Mountain Pro',
        'brand' => 'Trek',
        'year' => 2024,
    ];

    $response = post('/api/bikes?pagination[current]=1&pagination[pageSize]=15', $bikeData);

    $response->assertStatus(201)
        ->assertJson([
            'data' => $bikeData,
        ]);

    $this->assertDatabaseHas('bikes', $bikeData);
});

test('cannot create a bike with invalid data', function () {
    $response = post('/api/bikes', [
        'model' => '',
        'brand' => '',
    ], ['Accept' => 'application/json']);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['model', 'brand', 'year']);
});

test('can update a bike', function () {
    $bike = Bike::factory()->create();

    $updateData = [
        'model' => 'Updated Model',
        'brand' => 'Updated Brand',
        'year' => 2023,
    ];

    $response = put("/api/bikes/{$bike->id}", $updateData);

    $response->assertStatus(200);

    $this->assertDatabaseHas('bikes', array_merge(['id' => $bike->id], $updateData));
});

test('can delete a bike', function () {
    $bike = Bike::factory()->create();

    $response = delete("/api/bikes/{$bike->id}");

    $response->assertStatus(204);

    $this->assertDatabaseMissing('bikes', ['id' => $bike->id]);
});
