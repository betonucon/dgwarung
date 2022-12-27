<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewdetailorder extends Model
{
    protected $table = 'view_detail_order';
    protected $guarded = ['id'];
    public $timestamps = false;
    
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
