<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'p_no';
    public $incrementing = true;

    protected $attributes = [
        'p_last_dt' => '0000-00-00',
    ];

}

