<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCashRefund extends Model
{
    use HasFactory;
    protected $primaryKey = 'cr_no';
    public $incrementing = true;
}
