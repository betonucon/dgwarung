<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stokup extends Model
{
    protected $table = 'view_stok_up';
    public $timestamps = false;
    function mstokorder(){
        return $this->belongsTo('App\Stokorder','nomor_stok','nomor_stok');
    }
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
