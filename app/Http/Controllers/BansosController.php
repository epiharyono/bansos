<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Str;

class BansosController extends Controller
{

    static function IndexDetail($url){
      
    }

    static function GetDatas(){
        $data  = DB::table('ta_bansos')->orderBy('id','DESC')->get();
        foreach($data as $dat){
            $datas[]  = [
              'id'    => $dat->id,
              'judul'  => $dat->judul,
              'uraian'   => $dat->uraian,
              'slug'  => Str::slug($dat->judul),
            ];
        }
        if(!sizeOf($data)) $datas  = '';
        return ['authr'=>1, 'data'=>$datas];
    }

    static function TambahData($req){
        DB::table('ta_bansos')->insert([
          'judul'  => $req->judul,
          'uraian'   => $req->uraian,
          'created_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
          'updated_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
        ]);

        return ['error'=>0,'pesan'=>'Tambah Data Berhasil','data'=>self::GetDatas()];
    }

    static function EditData($url,$req){
        if(\Request::isMethod('POST')){
            DB::table('ta_bansos')->where('id',$req->id)->update([
              'judul'  => $req->judul,
              'uraian'   => $req->uraian,
              'updated_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
            ]);
            return ['error'=>0,'pesan'=>'Edit Data Berhasil','data'=>self::GetDatas()];
        }

        $split  = explode("-", $url);
        $id     = $split[0];
        $bansos = DB::table('ta_bansos')->where('id',$id)->first();
        if($bansos){
            $data = [
              'id'  => $bansos->id,
              'judul' => $bansos->judul,
              'uraian'  => $bansos->uraian,
            ];
            $error = 0; $pesan = '';
        }else{
            $error = 1; $data = ''; $pesan = 'Data Tidak Ditemukan';
        }
        return ['error'=>$error, 'pesan'=>$pesan, 'data'=>$data];
    }

    static function HapusData($req){
        if(\Request::isMethod('POST')){
            $del = DB::table('ta_bansos')->where('id',$req->id)->delete();
            if($del) return ['error'=>0,'pesan'=>'Hapus Data Berhasil','data'=>self::GetDatas()];
            else return ['error'=>1,'pesan'=>'Hapus Data Gagal','data'=>self::GetDatas()];
        }
    }
}
