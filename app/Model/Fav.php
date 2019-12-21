<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fav extends Model
{
    protected $table = 'favorite';
    protected $primarykey = 'fav_id';
    public $timestamps = false;
    protected $fillable = ['*'];
}
