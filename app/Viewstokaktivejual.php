<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewstokaktivejual extends Model
{
    protected $table = 'view_stok_aktive_jual';
    protected $guarded = ['id'];
    public $timestamps = false;
   
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
