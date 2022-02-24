<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardsComment extends Model
{
    use HasFactory;

    protected $primaryKey = 'c_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'c_comments' => '',
    ];
}
