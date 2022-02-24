<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner_review extends Model
{
    use HasFactory;

    protected $primaryKey = 'rv_no';
    public $incrementing = true;
}
