<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasLocation;

class Distributor extends Model
{
    use HasLocation;

    protected $table = 'distributors';

    public function sendingTransactions() {
        return $this->hasMany('App\Transaction', 'sender_id');
    }

    public function receivingTransactions() {
        return $this->hasMany('App\Transaction', 'receiver_id');
    }

    public function getTransactionsAttribute() {
        return $this->sendingTransactions->merge($this->receivingTransactions);
    }
}
