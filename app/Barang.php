<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Barang to PesananDetail
    // 1 to many
    public function pesanan_details()
    {
        return $this->hasMany('App\PesananDetail','barang_id','id');
    }
}
