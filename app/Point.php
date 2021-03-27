<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\City;

class Point extends Model
{
    public function city(){
        return $this->hasOne(City::class);
    }
}
