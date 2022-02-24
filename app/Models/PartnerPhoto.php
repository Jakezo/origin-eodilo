<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerPhoto extends Model
{
    use HasFactory;

    protected $primaryKey = 'pt_no';
    public $incrementing = true;
}
