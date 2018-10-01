<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'producer' => $this->producer,
            'harvested_at' => $this->harvested_at,
            'transactions' => $this->transactions->each(function ($transaction) {
                $transaction->sender;
                $transaction->receiver;
                $transaction->status;
                $transaction->sender->location;
                $transaction->receiver->location;
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
