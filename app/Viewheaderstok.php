<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewheaderstok extends Model
{
    protected $table = 'view_headerstok';
    protected $guarded = ['id'];
    public $timestamps = false;
    
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
