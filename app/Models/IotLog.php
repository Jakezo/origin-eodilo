<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class iotLog extends Model
{
    use HasFactory;
    protected $primaryKey = 'log_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];
}
