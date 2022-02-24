<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrenchLaptops extends Model
{
    use HasFactory;
    
    protected $connection = 'partner';

    protected $primaryKey = 'lap_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];

}
