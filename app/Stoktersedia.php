<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stoktersedia extends Model
{
    protected $table = 'stok_tersedia';
    protected $guarded = [];
    public $timestamps = false;
    
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
