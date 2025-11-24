<?php

namespace App\Models;

use App\Http\Resources\RentResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SupplementBacon\LaravelPaginable\Paginable;

class Rent extends Model
{
    use HasFactory, Paginable;

    const RESOURCE = RentResource::class;

    protected $fillable = [
        'bike_id',
        'user_id',
        'rent_start',
        'rent_end',
        'total_price',
    ];

    public static function storeRules(): array
    {
        return [
            'bike_id'     => 'required|exists:bikes,id',
            'user_id'     => 'required|exists:users,id',
            'rent_start'  => 'required|date|before:rent_end',
            'rent_end'    => 'required|date|after:rent_start',
            'total_price' => 'required|numeric|min:0',
        ];
    }

    public static function updateRules(int $id): array
    {
        return [
            'bike_id'     => 'sometimes|exists:bikes,id',
            'user_id'     => 'sometimes|exists:users,id',
            'rent_start'  => 'sometimes|date|before:rent_end',
            'rent_end'    => 'sometimes|date|after:rent_start',
            'total_price' => 'sometimes|numeric|min:0',
        ];
    }

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
