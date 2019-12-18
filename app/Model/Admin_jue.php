<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_jue extends Model
{
    protected $table = 'admin_jue';
    protected $primaryKey = 'j_id';
    public $timestamps = false;
    protected $guarded = [];
}
