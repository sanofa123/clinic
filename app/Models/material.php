<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    public function category() {
        return $this->belongsTo('category');
    }
}