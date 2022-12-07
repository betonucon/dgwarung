<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewkeuangan extends Model
{
    protected $table = 'view_keuangan';
    protected $guarded = ['id'];
    public $timestamps = false;
    
}
