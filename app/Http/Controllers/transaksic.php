<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\transaksi;
use App\detail_trans;
use App\jenis_cuci;
use Validator;
use DB;
use Hash;
use Auth;

class transaksic extends Controller
{
    public function insert(Request $r){
if(Auth::user()->level == "petugas"){
        $validator = Validator::make($r->all(), [
        'id_pelanggan' => 'required',
        'id_jenis' => 'required',
        'berat' => 'required',
        ]);
        if($validator->fails()){
            return response()->json('invalid input');
        }
        $jenis = jenis_cuci::where('id',$r->id_jenis)->first();
        $harga = $jenis->harga_per_kg;
        $total = $harga * $r->berat;
        if($r->berat2 != null){
        $total2 = $harga * $r->berat2;
        }
        $date = Date('Y-m-d H:i:s');
        $date2 = date('Y-m-d H:i:s', strtotime('+2 days', strtotime($date)));
        $transaksi = transaksi::create([
            'id_pelanggan' => $r->id_pelanggan,
            'id_petugas' => Auth::user()->id,
            'tgl_transaksi' => $date,
            'tgl_selesai' => $date2
        ]);
        $tgl_trans = transaksi::where('tgl_transaksi','=',$date,'and','tgl_selesai','=',$date2)->first();
        $id = $tgl_trans->id;
        $detail = detail_trans::create([
            'id_trans' => $id,
            'id_jenis' => $r->id_jenis,
            'berat' => $r->berat,
            'subtotal' => $total
        ]);
        if($r->berat2 != null){
        $detail2 = detail_trans::create([
            'id_trans' => $id,
            'id_jenis' => $r->id_jenis2,
            'berat' => $r->berat2,
            'subtotal' => $total,
        ]);
        if($transaksi && $detail && $detail2){
            return response()->json('berhasil melakukan transaksi');
        }
        else{
            return response()->json('gagal melakukan transaksi');
        }
        }
        else{
            if($transaksi && $detail){
                return response()->json('berhasil melakukan transaksi');
            }
            else{
                return response()->json('gagal melakukan transaksi');
            }
        }
         }
        else{
            return response("Anda bukan petugas");
        }
    }
    public function get(Request $r){
if(Auth::user()->level == "petugas"){
    $trans = DB::table('transaksi')->join('pelanggan','pelanggan.id','=','transaksi.id_pelanggan')
             ->join('petugas','petugas.id','=','transaksi.id_petugas')
             ->where('transaksi.tgl_transaksi','>=',$r->tgl_awal)
             ->where('transaksi.tgl_transaksi','<=',$r->tgl_akhir)
             ->select('transaksi.tgl_transaksi','pelanggan.nama','pelanggan.alamat','pelanggan.telp','transaksi.tgl_selesai','transaksi.id')
             ->get();
    $hasil = array();
    foreach($trans as $t){
        $grand = DB::table('detail_trans')
                 ->where('id_trans','=',$t->id)
                 ->groupBy('id_trans')
                 ->select(DB::raw('sum(subtotal) as grandtotal'))
                 ->first();
        $detail = DB::table('detail_trans')->join('jenis_cuci','jenis_cuci.id','=','detail_trans.id_jenis')
                  ->where('id_trans','=',$t->id)
                  ->select('detail_trans.*','jenis_cuci.*')
                  ->get();
        $hasil2 = array();
        foreach($detail as $d){
        $hasil2[] = array(
            'id transaksi' => $d->id_trans,
            'jenis cuci' => $d->nama_jenis,
            'berat' => ''.$d->berat.' kg',
            'harga per kg' => $d->harga_per_kg,
            'subtotal' => $d->subtotal
        ); 
    }
        $hasil[] = array(
            'tanggal transaksi' => $t->tgl_transaksi,
            'nama pelanggan' => $t->nama,
            'alamat' => $t->alamat,
            'telepon' => $t->telp,
            'tanggal selesai' => $t->tgl_selesai,
            'total transaksi' => $grand->grandtotal,
            'detail transaksi' => $hasil2,
        );
    }
    return response()->json(compact('hasil'));
     }
        else{
            return response("Anda bukan petugas");
        }
    }
    
    public function update(Request $r){
        if(Auth::user()->level == "petugas"){
        $validator = Validator::make($r->all(), [
            'id_jenis' => 'required',
            'berat' => 'required',
            ]);
        if($validator->fails()){
            return response()->json('invalid input');
        }
        $get = DB::table('transaksi')->join('pelanggan','transaksi.id_pelanggan','=','pelanggan.id')
               ->join('detail_trans','transaksi.id','=','detail_trans.id_trans')
               ->where('pelanggan.nama','like','%'.$r->nama_pelanggan.'%','and','transaksi.tgl_transaksi','like','%'.$r->tgl_transaksi.'%')
               ->get('transaksi.id','pelanggan.nama','detail_trans.*')
               ->get();
        $id = $get->id;
        $jenis = $get->id_jenis;
        $berat_awal =  $get->berat;
        $berat_akhir = $berat_awal + $r->berat;
        $update1 = DB::table('detail_trans')
                   ->where('id_trans','=',$id)
                   ->where('id_jenis','=',$jenis)
                   ->update([
                   'id_jenis' => $r->id_jenis,
                   'berat' => $berat_akhir
        ]);
        if($update1){
            $status = "berhasil update data transaksi milik ".$get->nama."";
            return response()->json(compact('status'));
        }
        else{
            $status = "gagal update data transaksi milik ".$get->nama."";
            return response()->json(compact('status'));
        }
           }
        else{
            return response("Anda bukan petugas");
        }       
        
    }
}
