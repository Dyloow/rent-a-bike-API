<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SupplementBacon\LaravelPaginable\Paginable;


class Bike extends Model
{
    use hasFactory,Paginable;
    const RESOURCE = \App\Http\Resources\BikeResource::class;

    protected $fillable = [
        'model',
        'brand',
        'year',
    ];

    public static function storeRules(): array
    {
        return [
            'model'          => 'required|string',
            'brand'          => 'required|string',
            'year'           => 'required|integer',
        ];
    }

    public static function updateRules(): array
    {
        return [
            'model'          => 'sometimes|string',
            'brand'          => 'sometimes|string',
            'year'           => 'sometimes|integer',
        ];
    }


    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

}
