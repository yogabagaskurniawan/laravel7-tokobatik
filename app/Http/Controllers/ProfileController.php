<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        
        return view('profile.index', compact('user'));
    }
    
    public function update(Request $req)
    {
        $this->validate($req,[
            'password' => 'confirmed'
        ]);
        
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->nohp = $req->nohp;
        $user->alamat = $req->alamat;

        if(!empty($req->password)){
            $user->password = Hash::make($req->password);
        }

        $user->update();

        return redirect('/profile')->with('success', 'Profile berhasil di update');
    }
}
