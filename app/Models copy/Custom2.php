<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Custom2 extends Model
{
    use HasFactory;

    protected $primaryKey = 'q_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];
}
