<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'm_satuan';
    protected $guarded = ['id'];
    public $timestamps = false;
    
}
