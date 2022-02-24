<?php
 namespace App;
 
 use Illuminate\Notifications\Notifiable;
 use Illuminate\Foundation\Auth\User as Authenticatable;

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use Notifiable;
    //use HasFactory;

    protected $guard = 'admin';
    protected $primaryKey = 'admin_no';
    public $incrementing = true;
    //public $incrementing = false;
    //protected $keyType = 'string';
    //protected $connection = 'connection-name';

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'admin_login_last' => '0000-00-00 00:00:00',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
