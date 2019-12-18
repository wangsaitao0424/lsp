<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Api_gods extends Model
{
    protected $table = 'api_gods';
    protected $primaryKey = 'goods_id';
    public $timestamps = false;
    protected $guarded = [];
}
