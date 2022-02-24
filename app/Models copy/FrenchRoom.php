<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrenchRoom extends Model
{
    use HasFactory;
    protected $connection = 'partner';

    protected $primaryKey = 'r_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];
}
