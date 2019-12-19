<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_userJue extends Model
{
    protected $table = 'admin_userJue';
    protected $primaryKey = 'userj_id';
    public $timestamps = false;
    protected $guarded = [];
}
