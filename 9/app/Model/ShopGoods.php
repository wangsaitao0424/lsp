<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopGoods extends Model
{
    protected $table = 'shop_goods';
    protected $primaryKey = 'goods_id';
    public $timestamps = false;
    protected $guarded = [];
}
