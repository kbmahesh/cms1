<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class management_credentials extends Authenticatable
{
    use Notifiable;

    protected $table = 'management_credentials';

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public $timestamps = false;

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
