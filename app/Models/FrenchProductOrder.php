<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class FrenchProductOrder extends Model
{
    use HasFactory;
    protected $connection = 'partner';

    protected $primaryKey = 'o_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];
}
