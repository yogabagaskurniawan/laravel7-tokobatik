<?php

namespace App\Http\Controllers;

use App\Pesanan;
use App\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status','!=',0)->get();
        return view('history.index', compact('pesanans'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesananDetail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        return view('history.detail', compact('pesanan', 'pesananDetail'));
    }
}
