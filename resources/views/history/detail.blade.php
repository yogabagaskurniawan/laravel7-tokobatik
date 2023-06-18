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
          <li class="breadcrumb-item"><a href="/history">Riwayat Pemesanan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
        </ol>
      </nav>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card mb-3">
        <div class="card-body">
          <h3>Sukses Ceck Out</h3>
          <h5>Pesanan anda sudah sukses chek out selanjutnya untuk pembayaran silahkan transfer di rekening <strong>Bank BRI nomer rekening : 21203-313923-839</strong> dengan nominal : <strong> Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</strong></h5>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="card-body">
                <h2 class="card-title"><i class="bi bi-cart-fill"></i> Detail Pemesanan</h2>
                {{-- <p align="right">Tanggal : {{ $pesanan->tanggal }}</p> --}}
                @if ($pesanan)
                  <p align="right">Tanggal : {{ $pesanan->tanggal }}</p>
                @endif
                <table class="table table-striped">
                  <thead>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                  </thead>
                  <tbody>
                    @php  $no = 1 @endphp
                    @if ($pesananDetail)
                      @foreach ($pesananDetail as $pesananDetail)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td><img src="{{ url('upload/'.$pesananDetail->barangs->gambar) }}" class="img-fluid rounded-start" width="100px" alt="..."></td>
                        <td>{{ $pesananDetail->barangs->nama_barang }}</td>
                        <td>{{ $pesananDetail->jumlah_produk }}</td>
                        <td>Rp. {{ number_format($pesananDetail->barangs->harga)  }}</td>
                        <td>Rp. {{ number_format($pesananDetail->jumlah_harga)  }}</td>
                      </tr>
                      @endforeach
                    @endif
                    @if ($pesanan)
                    <tr>
                      <td colspan="5" align="right"><strong>Total harga  =</strong></td>
                      <td>
                        <strong>Rp. {{ number_format($pesanan->jumlah_harga) }} </strong>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="5" align="right"><strong>Kode unik  =</strong></td>
                      <td>
                        <strong>Rp. {{ number_format($pesanan->kode) }} </strong>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="5" align="right"><strong>Total yang harus ditransfer  =</strong></td>
                      <td>
                        <strong>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }} </strong>
                      </td>
                    </tr>
                    @endif
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
