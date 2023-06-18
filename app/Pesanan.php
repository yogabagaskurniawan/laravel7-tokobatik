<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    // pesanan to user
    // many to 1
    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    // pesanan to pesananDetail
    // 1 to many
    public function pesanan_details()
    {
        return $this->hasMany('App\PesananDetail','pesanan_id','id');
    }
}
