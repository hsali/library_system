<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    protected $fillable = ["name"];

    public function books(){
        return $this->hasMany("\App\Book");
    }

}
