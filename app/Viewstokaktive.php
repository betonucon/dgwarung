<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewstokaktive extends Model
{
    protected $table = 'view_stok_aktive';
    protected $guarded = ['id'];
    public $timestamps = false;
    function msupplier(){
        return $this->belongsTo('App\Supplier','supplier_id','id');
    }
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
