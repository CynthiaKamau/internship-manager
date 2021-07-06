<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles, LogsActivity, ThrottlesLogins;
    protected static $ignoreChangedAttributes = ['password'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'email', 'nckid', 'role_id', 'msisdn', 'profile_photo', 'status', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected static $logFillable = true;
    protected static $logName = 'user';
    protected static $logOnlyDirty = true;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_id' => 'integer'
    ];

    public function setStatusAttribute($status)
    {
        $this->attributes['status'] = ($status)? 1 : 0;
    }
    public function setPasswordAttribute($password)
    {
        if(Hash::needsRehash($password)){
            $password = Hash::make($password);
            $this->attributes['password'] = $password;
        }
    }
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    public function facilities()
    {
        return $this->belongsTo('App\Models\Facility');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\Profile', 'user_id');
    }

    public function checkins()
    {
        return $this->hasMany('App\Models\Checkins');
    }

    
}
