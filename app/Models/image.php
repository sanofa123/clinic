<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'caption', 'patient_id', 'admin_id', 'created_at',
    ];
}