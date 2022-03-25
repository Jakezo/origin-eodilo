<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileProductOrder extends Model
{
    use HasFactory;

    protected $primaryKey = 'o_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];
}
