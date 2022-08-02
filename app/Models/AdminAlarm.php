<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAlarm extends Model
{
    use HasFactory;
    protected $primaryKey = 'a_no';
    public $incrementing = true;
}
