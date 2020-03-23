<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jenis_cuci;
use Validator;
use DB;
use Hash;
use Auth;

class jenis_cucic extends Controller
{
    public function insert(Request $r){
        if(Auth::user()->level == "admin"){
        $validator = Validator::make($r->all(), [
            'nama_jenis' => 'required|string',
            'harga_per_kg' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json('invalid input data');
        }

        $jenis = jenis_cuci::create([
            'nama_jenis' => $r->nama_jenis,
            'harga_per_kg' => $r->harga_per_kg,
        ]);

        if($jenis){
            $status = "berhasil input data jenis cuci";
            return response()->json(compact('status'));
        }

        else{
            $status = "gagal input data jenis cuci";
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
            'nama_jenis' => 'required',
            'harga_per_kg' => 'required'
        ]);
        if($validator->fails()){
            return response()->json('invalid input');
        }
        $tayang = jenis_cuci::where('id',$id)->update([
            'nama_jenis' => $r->nama_jenis,
            'harga_per_kg' => $r->harga_per_kg
        ]);
        if($tayang){
            $status = "berhasil update data jenis cuci";
            return response()->json(compact('status'));
        }
        else{
            $status = "gagal update data jenis cuci";
            return response()->json(compact('status'));
        }
    }
    else{
            return response("Anda bukan admin");
        }
    }
    public function destroy($id){
if(Auth::user()->level == "admin"){
        $hapus = jenis_cuci::where('id',$id)->delete();

        if($hapus){
            $status = "berhasil hapus data jenis cuci";
            return response()->json(compact('status'));
        }
        
        else{
            $status = "gagal hapus data jenis cuci";
            return response()->json(compact('status'));
        }
         }
        else{
            return response("Anda bukan admin");
        }
    }

}
