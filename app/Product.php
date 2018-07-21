<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function farmer() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
}
