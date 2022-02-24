<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCashBuy extends Model
{
    use HasFactory;
    protected $primaryKey = 'cb_no';
    public $incrementing = true;
}
