<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShopBrand extends Model
{
    protected $table = 'shop_brand';
    protected $primaryKey = 'shop_id';
    public $timestamps = false;
    protected $guarded = [];
}
