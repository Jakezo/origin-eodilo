<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrenchProduct extends Model
{
    use HasFactory;
    protected $connection = 'partner';

    protected $primaryKey = 'prd_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];
}
