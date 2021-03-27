<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Point;

class City extends Model
{
    public function points(){
        return $this->hasMany(Point::class);
    }
}
