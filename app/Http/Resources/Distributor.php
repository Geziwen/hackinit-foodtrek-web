<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Distributor extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'address' => $this->latitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'transactions' => $this->transactions,
        ];
    }
}
