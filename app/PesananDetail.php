<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    // PesananDetail to Barang
    // many to 1
    public function barangs()
    {
        return $this->belongsTo('App\Barang', 'barang_id', 'id');
    }

    // PesananDetail to pesanan
    // many to 1
    public function pesanans()
    {
        return $this->belongsTo('App\Pesanan','pesanan_id','id');
    }
}
