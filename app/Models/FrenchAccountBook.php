<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrenchAccountBook extends Model
{
    use HasFactory;

    protected $connection = 'partner';

    protected $primaryKey = 'ab_no';
    public $incrementing = true;

    protected $dates = ['deleted_at'];

    public function posts(){
        return $this->hasManyThrough(
            "App\FrenchAccountDiv",
            "d_no",
            "ab_div"
        );
    }

}
