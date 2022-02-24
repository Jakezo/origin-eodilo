<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'admin_no';
    public $incrementing = true;
    protected $guard = 'admin';

    protected $fillable = [
        'admin_id', 'admin_name', 'admin_email', 'admin_passwd',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}