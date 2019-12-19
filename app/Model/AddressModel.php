<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    //
    protected $table = 'address';
    protected $primarykey = 'add_id';
    public $timestamps = false;
    protected $fillable = ['*'];
}
