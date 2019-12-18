<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_adver extends Model
{
    protected $table = 'adver';
    protected $primaryKey = 'ad_id';
    public $timestamps = false;
    protected $guarded = [];
}
