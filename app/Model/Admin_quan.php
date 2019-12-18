<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_quan extends Model
{
    protected $table = 'admin_quan';
    protected $primaryKey = 'q_id';
    public $timestamps = false;
    protected $guarded = [];
}
