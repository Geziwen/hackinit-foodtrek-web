<?php

namespace App\Traits;

trait HasLocation {

    public function getLongitudeAttribute() {
        return json_decode($this->location)->longitude;
    }

    public function getLatitudeAttribute() {
        return json_decode($this->location)->latitude;
    }

    public function getAddressAttribute() {
        return json_decode($this->location)->address;
    }
}
