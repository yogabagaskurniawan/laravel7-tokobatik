<?php

namespace App\Http\Controllers;

use App\User;
use App\Barang;
use App\Pesanan;
use Carbon\Carbon;
use App\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $barang = Barang::where('id',$id)->first();
        return view('pesanan.index', compact('barang'));
    }

    public function pesanan(Request $req, $id)
    {
        $barang = Barang::where('id',$id)->first();
        // menangkap tanggal pada saat ini
        $tanggal = Carbon::now();

        // cek validasi ketika user memesan melebihi stok
        if ($req->jml_pesanan > $barang->stok) {
            return redirect('pesan/' . $id);
        }

        // cek validasi apakah user_id sebelumnya sudah memesan atau belum jika sudah pernah memesan maka di tabel pesanan hanya ada satu user_id (digabung satu baris) karena yang memesan satu user_id 
        $cekUserPesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        // simpan ke table pesanan
        if (empty($cekUserPesanan)) {
            // jika belum ada
            $pesanan = new Pesanan();
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(100,999);
            $pesanan->save();
        }

        // simpan ke table pesananDetail
        // menangkap id tabel pesanan
        $idPesananBaru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // cek validasi jika memesan barang_id dan pesanan_id sama seperti yang sebelumnya maka digabung menjadi satu baris di tabel pesanan detail
        $cekPesananDetail = PesananDetail::where('barang_id',$barang->id)->where('pesanan_id',$idPesananBaru->id)->first();
        if(empty($cekPesananDetail)){
            // jika belum ada
            $pesananDetail = new PesananDetail();
            $pesananDetail->barang_id = $barang->id;
            $pesananDetail->pesanan_id = $idPesananBaru->id;
            $pesananDetail->jumlah_produk = $req->jml_pesanan;
            $pesananDetail->jumlah_harga = $barang->harga*$req->jml_pesanan;
            $pesananDetail->save();
        }else{
            // jika sudah ada
            $pesananDetail = PesananDetail::where('barang_id',$barang->id)->where('pesanan_id',$idPesananBaru->id)->first();
            $pesananDetail->jumlah_produk = $pesananDetail->jumlah_produk+$req->jml_pesanan;

            // harga baru atau harga sekarang
            $hargaBaru  = $barang->harga*$req->jml_pesanan;
            $pesananDetail->jumlah_harga = $pesananDetail->jumlah_harga+$hargaBaru;
            $pesananDetail->save();
        }

        // total jumlah_harga di tabel pesanan
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga+$barang->harga*$req->jml_pesanan;
        $pesanan->update();

        return redirect('/home')->with('success', 'Pesanan sukses masuk keranjang');
    }

    public function checkOut()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesananDetail = null;
        
        if (!empty($pesanan)) {
            $pesananDetail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }
        
        return view('pesanan.checkOut', compact('pesanan', 'pesananDetail'));
    }


    public function delete($id)
    {
        $pesananDetail = PesananDetail::where('id', $id)->first();
        $pesanan = Pesanan::where('id', $pesananDetail->pesanan_id)->first();

        $pesanan->jumlah_harga = $pesanan->jumlah_harga-$pesananDetail->jumlah_harga;
        $pesanan->update();

        $pesananDetail->delete();

        return redirect('/check-out')->with('error', 'Pesanan sukses dihapus');
    }

    public function konfirmasi()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if(empty($user->alamat)){
            return redirect('/profile')->with('error', 'Identitas harus dilengkapi');
        }
        if(empty($user->nohp)){
            return redirect('/profile')->with('error', 'Identitas harus dilengkapi');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();

        $pesananDetail = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesananDetail as $psnDetail) {
            $barang = Barang::where('id', $psnDetail->barang_id)->first();
            $barang->stok = $barang->stok-$psnDetail->jumlah_produk;
            $barang->update();
            // $psnDetail->delete();
        }

        return redirect('history/'.$pesanan_id)->with('success', 'Pesanan sukses check out silahkan lanjutkan proses pembayaran');
    }
}
