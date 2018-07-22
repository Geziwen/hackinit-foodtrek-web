<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    public function type() {
        return $this->belongsTo('App\Food', 'type_id');
    }

    public function producer() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }

    public function getStatusAttribute() {
        if ($this->harvested_at === null) {
            return 'planted';
        }
        if ($this->transactions->count()) {
            return 'transporting';
        }
        return 'harvested';
    }
}
