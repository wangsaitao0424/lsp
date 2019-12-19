<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_quanJue extends Model
{
    protected $table = 'admin_quanJue';
    protected $primaryKey = 'qj_id';
    public $timestamps = false;
    protected $guarded = [];
}
