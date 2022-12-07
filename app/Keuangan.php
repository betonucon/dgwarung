<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 't_keuangan';
    protected $guarded = ['id'];
    public $timestamps = false;
    function mstatuskeuangan(){
        return $this->belongsTo('App\Models\Statuskeuangan','status_keuangan','id');
    }
    function mkategorikeuangan(){
        return $this->belongsTo('App\Models\Kategorikeuangan','kategori_keuangan','id');
    }
    // function mgroup(){
    //     return $this->belongsTo('App\Models\Group','group_id','id');
    // }
    // function mpendidikan(){
    //     return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    // }
}
