<?php

namespace App;

use App\Traits\HasLocation;
use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    use HasLocation;

    protected $table = 'producers';

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
