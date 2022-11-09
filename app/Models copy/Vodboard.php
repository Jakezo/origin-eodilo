<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vodboard extends Model
{
    protected $primaryKey = 'b_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'b_partner' => '',
        'b_level' => 0,
        'b_files' => '',
        'b_read' => 0,
    ];
}
