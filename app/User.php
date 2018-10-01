<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function producer() {
        return $this->belongsTo('App\Producer', 'link');
    }

    public function distributor() {
        return $this->belongsTo('App\Distributor', 'link');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function getLocationAttribute() {
        if ($this->role->name === 'producer') {
            return $this->producer->locationInfo;
        } else if ($this->role->name === 'distributor') {
            return $this->distributor->locationInfo;
        }
        return null;
    }
}
