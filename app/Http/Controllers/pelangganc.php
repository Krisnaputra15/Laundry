<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Validator;
use Auth;
use App\pelanggan;

class pelangganc extends Controller
{
    public function register(Request $r){
if(Auth::user()->level == "admin"){
    $validator = Validator::make($r->all(), [
        'nama' => 'required|string|max:255',
        'alamat' => 'required',
        'telp' => 'required',
    ]);

    if($validator->fails()){
        return response()->json($validator->errors()->toJson(), 400);
    }

    $user = pelanggan::create([
        'nama' => $r->get('nama'),
        'telp' => $r->get('telp'),
        'alamat' => $r->get('alamat'),
    ]);
        if($user){
        $status = "Berhasil Daftar User";
        return response()->json(compact('status'));
        }
        else{
        $status = "Gagal Daftar User";
        return response()->json(compact('status'));
        }
         }
        else{
            return response("Anda bukan admin");
        }
    }
    public function update($id,Request $r){
if(Auth::user()->level == "admin"){
        $validator = Validator::make($r->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required'
        ]);
        if($validator->fails()){
            return response()->json('invalid input');
        }
        $tayang = pelanggan::where('id',$id)->update([
            'nama' => $r->nama,
            'alamat' => $r->alamat,
            'telp' => $r->telp
        ]);
        if($tayang){
            $status = "berhasil update data pelanggan";
            return response()->json(compact('status'));
        }
        else{
            $status = "gagal update data pelanggan";
            return response()->json(compact('status'));
        }
         }
        else{
            return response("Anda bukan admin");
        }
    }
    public function delete($id){
if(Auth::user()->level == "admin"){
        $nama = pelanggan::where('id',$id)->first();
        $user = pelanggan::where('id',$id)->delete();
        if($user){
            $status = "berhasil hapus data user milik ".$nama->nama."";
            return response()->json(compact('status'));
        }
        else{
            $status = "gagal hapus data user milik ".$nama->nama."";
            return response()->json(compact('status'));
        }
         }
        else{
            return response("Anda bukan admin");
        }
    }
    public function get(Request $r){
        $pelanggan = DB::table('pelanggan')->where('nama','like','%'.$r->nama.'%','or','alamat','like','%'.$r->alamat.'%','or','telp','like',''.$r->telp.'')
                     ->select('nama','alamat','telp')->get();
        if($pelanggan){
            $arr_pelanggan = array();
            foreach($pelanggan as $p){
                $arr_pelanggan[] = array(
                    'nama pelanggan' => $p->nama,
                    'alamat' => $p->alamat,
                    'nomer telepon' => $p->telp
                );
            }
        }
        else{
            $hasil = "tidak ada pelanggan yang bernama ".$r->nama."";
            return response()->json(compact('hasil'));
        }
        if($pelanggan){
        $result[] = array(
            'pencarian' => $r->all(),
            'hasil' => $arr_pelanggan
        );
        }
        else{
            $result[] = array(
                'pencarian' => $r->all(),
                'hasil' => 'tidak ada hasil yang cocok'
            );
        }
        return response()->json(compact('result'));
    }
}
