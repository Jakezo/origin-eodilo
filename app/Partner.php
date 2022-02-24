<?php
 namespace App;
 
 use Illuminate\Notifications\Notifiable;
 use Illuminate\Foundation\Auth\User as Authenticatable;

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Authenticatable
{
    use Notifiable;
    //use HasFactory;

    protected $connection = 'partner';
    protected $guard = 'partner';
    protected $primaryKey = 'mn_no';
    public $incrementing = true;
    //protected $keyType = 'string';

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'mn_login_last' => '0000-00-00 00:00:00',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
  
}
