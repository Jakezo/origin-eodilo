<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory;

    protected $primaryKey = 'b_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];

    protected $attributes = [
        'b_partner' => '',
        'b_level' => 0,
        'b_files' => '',
        'b_read' => 0,
    ];

    public function setBoard($b_id="")
    {
        if( $b_id ) $this->table = $b_id;
    }

}
