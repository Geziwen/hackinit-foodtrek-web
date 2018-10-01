<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = "transactions";

    public function sender() {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo('App\User', 'receiver_id');
    }

    public function product() {
        return $this->belongsTo('App\Product');
    }

    public function getStatusAttribute() {
        if ($this->deleted_at !== null) {
            return 'deleted';
        } else if ($this->confirmed_at === null) {
            return 'requested';
        } else if ($this->received_at === null) {
            return 'confirmed';
        } else {
            return 'received';
        }
    }
}
