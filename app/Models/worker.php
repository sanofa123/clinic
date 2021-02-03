<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class worker extends Model
{
    public function clinic() {
        return $this->belongsTo('clinic');
    }
}