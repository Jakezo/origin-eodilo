<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileReservSeat extends Model
{
    use HasFactory;

    protected $primaryKey = 'rv_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];
}
