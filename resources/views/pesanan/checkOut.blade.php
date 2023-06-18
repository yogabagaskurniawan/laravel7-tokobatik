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
          <li class="breadcrumb-item active" aria-current="page">Check Out</li>
        </ol>
      </nav>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="card-body">
                <h2 class="card-title"><i class="bi bi-cart-fill"></i> Check Out</h2>
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
                    <th>Aksi</th>
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
                        <td>
                          {{-- <a href="" class="btn btn-danger btn-" onclick="return confirm('Apakah yakin untuk dihapus?')"><i class="bi bi-trash"></i></a> --}}
                          <form action="/check-out/{{ $pesananDetail->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin untuk dihapus?')"><i class="bi bi-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    @endif
                    <tr>
                      @if ($pesanan)
                      <td colspan="5" align="right"><strong>Total harga  =</strong></td>
                      <td>
                        <strong>Rp. {{ number_format($pesanan->jumlah_harga) }} </strong>
                      </td>
                      <td>
                        <a href="check-out-konfirmasi" class="btn btn-success" onclick="return confirm('Apakah yakin untuk check out?')"><i class="bi bi-cart4"></i> Check out</a>
                      </td>
                      @endif
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
