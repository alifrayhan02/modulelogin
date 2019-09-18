<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelKontak;
use Session;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function cek(Request $req)
    {
        $this->validate($req,[
            'username'=>'required',
            'password'=>'required'
        ]);
        $proses=ModelKontak::where('username',$req->username)->where('password',$req->password)->first();
        if($proses!=""){
            Session::put('id_kontak',$proses->id_kontak);
            Session::put('username',$proses->username);
            Session::put('password',$proses->password);
            Session::put('hak_akses',$proses->hak_akses);
            Session::put('nama',$proses->nama);
            Session::put('login_status',true);
            return redirect('/kontak');
        }else{
            Session::flash('alert_pesan','Username dan password tidak cocok');
            return redirect('login');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login');
    }
}
