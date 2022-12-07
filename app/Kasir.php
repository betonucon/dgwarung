<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $table = 't_kasir';
    protected $guarded = ['id'];
    public $timestamps = false;
    
}
