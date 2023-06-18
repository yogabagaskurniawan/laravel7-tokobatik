@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mb-4">
      <a href="/home" class="btn btn-primary btn-lg"><i class="bi bi-arrow-left-square"></i> Kembali ke home</a>
    </div>
    <div class="col-md-12 mb-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang }}</li>
        </ol>
      </nav>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <img src="{{ url('upload/' . $barang->gambar) }}" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <h2 class="card-title">{{ $barang->nama_barang }}</h2>
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Harga</td>
                      <td>:</td>
                      <td>Rp.{{ number_format($barang->harga ) }}</td>
                    </tr>
                    <tr>
                      <td>Stok</td>
                      <td>:</td>
                      <td>{{ number_format($barang->stok)}}</td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td>{{ $barang->keterangan }}</td>
                    </tr>
                    <tr>
                      <td>Jumlah Pesan</td>
                      <td>:</td>
                      <td>
                        <form action="/pesan/{{ $barang->id }}" method="POST">
                          @csrf
                          <input type="number" name="jml_pesanan" placeholder="Silahkan mau pesan berapa.." required class="form-control">
                          <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-cart-fill"></i> Masukan Keranjang</button> 
                        </form>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
