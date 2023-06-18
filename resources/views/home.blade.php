@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 mb-4">
      <img src="{{ asset('img/logo.png') }}" width="700px" class="rounded mx-auto d-block " alt="">
    </div>
  </div>
  <div class="row justify-content-center">
    @foreach ($barangs as $brg)
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img src="{{ url('upload/' . $brg->gambar) }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $brg->nama_barang }}</h5>
            <p class="card-text">
              <strong>Harga : Rp. </strong>{{ number_format($brg->harga ) }} <br>
              <strong>Stok : </strong>{{ $brg->stok }}
              <hr>
              <strong>Keterangan : </strong> <br>
              {{ $brg->keterangan }}
            </p>
            <a href="/pesan/{{ $brg->id }}" class="btn btn-primary"><i class="bi bi-cart-fill"></i> Pesan</a>
        </div>
      </div>
    </div>
    @endforeach
    <div class="col-md-12 ">
      {{ $barangs->links() }}
    </div>
  </div>
</div>
@endsection
