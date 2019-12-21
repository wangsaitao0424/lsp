<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'car';
    protected $primarykey = 'car_id';
    public $timestamps = false;
    protected $fillable = ['*'];
}
