<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rent_start' => $this->rent_start,
            'rent_end' => $this->rent_end,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user.id' => $this->user_id,
            'user.name' => $this->user->name,
            'user.email' => $this->user->email,

            'bike.id' => $this->bike_id,
            'bike.model' => $this->bike->model,
            'bike.brand' => $this->bike->brand,
        ];
    }
}
