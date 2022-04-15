<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrenchIot extends Model
{
    use HasFactory;
    protected $connection = 'partner';

    protected $primaryKey = 'i_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];
}
