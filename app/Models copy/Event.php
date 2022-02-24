<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'e_no';
    public $incrementing = true;

    protected $attributes = [
        'e_sdate' => '0000-00-00',
        'e_edate' => '0000-00-00',
    ];
}
