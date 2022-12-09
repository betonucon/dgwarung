<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stokorder extends Model
{
    protected $table = 't_stok_order';
    protected $guarded = ['id'];
    public $timestamps = false;
    function msupplier(){
        return $this->belongsTo('App\Supplier','supplier_id','id');
    }
    function mstatuskeuangan(){
        return $this->belongsTo('App\Statuskeuangan','status_keuangan_id','id');
    }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
