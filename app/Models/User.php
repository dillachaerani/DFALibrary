<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, HasRoles;
    
    // activity logs
    protected static $logName = 'user';
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

    public function setPasswordAttribute($value)
    {
        if ($value)
            $this->attributes['password'] = \Hash::make($value);
        else
            unset($this->attributes['password']);
    }

    public function setUsernameAttribute($value)
    {
        return $this->attributes['username'] = strtolower($value);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
