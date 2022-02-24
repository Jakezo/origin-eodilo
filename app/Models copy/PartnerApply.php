<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerApply extends Model
{
    use HasFactory;

    protected $primaryKey = 'app_no';
    public $incrementing = true;
    //public $incrementing = false;
    //protected $keyType = 'string';
    //protected $connection = 'connection-name';
}
