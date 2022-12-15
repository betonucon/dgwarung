<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewstokbarang extends Model
{
    protected $table = 'view_stok_barang';
    protected $guarded = ['id'];
    public $timestamps = false;
   
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
