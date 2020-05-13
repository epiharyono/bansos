<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PendudukController extends Controller
{

    static function GetDatas(){
        $data  = DB::table('ta_penduduk')->orderBy('id','DESC')->get();
        foreach($data as $dat){
            $nm_kec   = strtolower($dat->nm_kec);
            $nm_desa  = strtolower($dat->nm_desa);
            $datas[]  = [
              'id'    => $dat->id,
              'nama'  => $dat->nama,
              'nik'   => $dat->nik,
              'tempat'   => $dat->tempat,
              'tanggal'   => $dat->tanggal,
              'id_prov'   => $dat->id_prov,
              'id_kab'   => $dat->id_kab,
              'nm_kec'   => ucfirst($nm_kec),
              'nm_desa'   => ucfirst($nm_desa),
              'alamat'  => $dat->alamat,
            ];
        }
        if(!sizeOf($data)) $datas  = '';
        return ['authr'=>1, 'data'=>$datas];
    }

    static function TambahDataPenduduk($req){
        $cek  = DB::table('ta_penduduk')->where('nik',$req->nik)->first();
        if(!$cek){
            $nm_prov  = DB::table('ref_provinces')->where('id',$req->id_prov)->value('name');
            $nm_kab   = DB::table('ref_regencies')->where('id',$req->id_kab)->value('name');
            $nm_kec   = DB::table('ref_districts')->where('id',$req->id_kec)->value('name');
            $nm_desa  = DB::table('ref_villages')->where('id',$req->id_desa)->value('name');
            DB::table('ta_penduduk')->insert([
              'nama'  => $req->nama,
              'nik'   => $req->nik,
              'tempat'   => $req->tempat,
              'tanggal'   => $req->tanggal,
              'id_prov'   => $req->id_prov,
              'id_kab'   => $req->id_kab,
              'id_kec'   => $req->id_kec,
              'id_desa'   => $req->id_desa,
              'nm_prov'   => $nm_prov,
              'nm_kab'   => $nm_kab,
              'nm_kec'   => $nm_kec,
              'nm_desa'   => $nm_desa,
              'alamat'  => $req->alamat,
              'created_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
              'updated_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
            ]);
        }

        return ['error'=>0,'pesan'=>'Tambah Data Berhasil','data'=>self::GetDatas()];
    }
}
