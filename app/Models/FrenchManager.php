<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FrenchManager extends Authenticatable
{
    use Notifiable;

    protected $connection = 'partner';
    public $incrementing = true;
    protected $guard = 'partner';
    protected $primaryKey = 'mn_no';

    protected $fillable = [
        'mn_id', 'mn_name', 'mn_email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
}