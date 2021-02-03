<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clinic extends Model
{
    public function nurses()
    {
        return $this->hasMany('App\Models\nurse')->count();
    }

    public function workers()
    {
        return $this->hasMany('App\Models\worker')->count();
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\reservation')->count();
    }

    public function materials()
    {
        return $this->hasMany('App\Models\material')->count();
    }
}