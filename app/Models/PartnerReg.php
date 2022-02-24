<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerReg extends Model
{
    use HasFactory;

    protected $primaryKey = 'pr_no';
    public $incrementing = true;

    protected $attributes = [
        'pr_sdate' => '0000-00-00',
        'pr_edate' => '0000-00-00',
    ];
}
