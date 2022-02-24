<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

//use Illuminate\Foundation\Auth\User as Authenticatable;

//class FrenchMember extends Authenticatable
class FrenchMember extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $connection = 'partner';
    public $incrementing = true;
    protected $guard = 'member';
    protected $primaryKey = 'mb_no';

    protected $fillable = [
        'mb_name', 'mb_hphone', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
}
