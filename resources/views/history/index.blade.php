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
          <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
        </ol>
      </nav>
    </div>
    <div class="col-md-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="card-body">
                <h2 class="card-title"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</h2>
                <table class="table table-striped">
                  <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Jumlah harga</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                    @php  $no = 1 @endphp
                    @foreach ($pesanans as $pesanans)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $pesanans->tanggal }}</td>
                      <td>
                        @if ( $pesanans->status == 1)
                          Sudah check out dan belum dibayar
                        @else
                          Sudah dibayar
                        @endif
                      </td>
                      <td>Rp. {{ number_format($pesanans->jumlah_harga+$pesanans->kode)  }}</td>
                      <td><a href="/history/{{ $pesanans->id }}" class="btn btn-primary"><i class="bi bi-info-lg"></i> Details</a></td>
                    </tr>
                    @endforeach
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
