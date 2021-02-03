<?php

namespace App\Models;

use App\Notifications\AdminEmailNotification;
use App\Notifications\PatientResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verify_token',
    ];

    public static function byEmail($email)
    {
        return static::where('email', $email)->first();
    }
    
    /**
     * Get the comments of a patient file.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\comment')->select('id', 'content', 'created_at', 'admin_id')->orderBy('created_at', 'Asc');
    }

    /**
     * Get the prescriptions of a patient file.
     */
    public function prescriptions()
    {
        return $this->hasMany('App\Models\prescription')->select('id', 'name', 'created_at', 'admin_id')->orderBy('created_at', 'Asc');
    }

    /**
     * Get the prescriptions of a patient file.
     */
    public function images()
    {
        return $this->hasMany('App\Models\image')->select('id', 'image', 'caption', 'created_at', 'admin_id')->orderBy('created_at', 'Asc');
    }

    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PatientResetPasswordNotification($token));
    }

    //Send email from admin to patient notification
    public function sendAdminEmailNotification($email, $subject, $admin_email)
    {
        $this->notify(new AdminEmailNotification($email, $subject, $this->name, $admin_email));
    }
}