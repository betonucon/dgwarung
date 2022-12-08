<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'm_employe';
    protected $guarded = ['id'];
    public $timestamps = false;
    
}
