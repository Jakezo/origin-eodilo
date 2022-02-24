<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $primaryKey = 'p_no';
    //public $incrementing = false;
    //protected $keyType = 'string';
    //protected $connection = 'connection-name';
    protected $attributes = [
        'p_last_dt' => '0000-00-00',
    ];

}
