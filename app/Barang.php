<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'm_barang';
    protected $guarded = ['id'];
    public $timestamps = false;
    function mSupplier(){
        return $this->belongsTo('App\Supplier','supplier_id','id');
    }
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
