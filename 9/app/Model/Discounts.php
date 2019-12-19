<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    protected $table = 'discounts';
    protected $primaryKey = 'dis_id';
    public $timestamps = false;
    protected $guarded = [];
}
