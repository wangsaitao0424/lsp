<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttrGoods extends Model
{
    protected $table = 'attr_goods';
    protected $primaryKey = 'attr_goods_id';
    public $timestamps = false;
    protected $guarded = [];
}
