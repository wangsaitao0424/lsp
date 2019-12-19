<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsPar extends Model
{
    protected $table = 'goods_par';
    protected $primaryKey = 'par_id';
    public $timestamps = false;
    protected $guarded = [];
}
