<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Str;

class BansosController extends Controller
{

    static function IndexDetail($url){
        $split  = explode("-", $url);
        $id     = $split[1];
        $bansos = DB::table('ta_bansos')->where('id',$id)->first();
        if($bansos){
            $data['title']  = $bansos->uraian;
            $data['id']     = $bansos->id;
            return view('bansos_detail',$data);
        }else{
            return redirect('/');
        }
    }

    static function GetDatas(){
        $data  = DB::table('ta_bansos')->orderBy('id','DESC')->get();
        foreach($data as $dat){
            $datas[]  = [
              'id'    => $dat->id,
              'tahun'   => $dat->tahun,
              'uraian_sd'   => $dat->uraian_sd,
              'id_sd'   => $dat->id_sd,
              'id_prog'   => $dat->id_prog,
              'uraian_prog'   => $dat->uraian_prog,
              'uraian'   => $dat->uraian,
              'slug'  => Str::slug($dat->uraian_prog.'-'.$dat->uraian),
            ];
        }
        if(!sizeOf($data)) $datas  = '';
        return ['authr'=>1, 'data'=>$datas];
    }

    static function GetData($url){
        $split  = explode("-", $url);
        $id     = $split[0];
        $bansos = DB::table('ta_bansos')->where('id',$id)->first();
        if($bansos){
            $data = [
              'id'  => $bansos->id,
              'uraian'  => $bansos->uraian,
            ];
            $error = 0; $pesan = ''; $login = 1;
        }else{
            $error = 1; $data = ''; $pesan = 'Data Tidak Ditemukan'; $login = 0;
        }
        return ['error'=>$error, 'pesan'=>$pesan, 'data'=>$data, 'isLogin'=>$login];
    }

    static function TambahData($req){
        $sd  = DB::table('ref_sumber_dana')->where('id',$req->id_sd)->value('uraian');
        $prog  = DB::table('ref_program')->where('id',$req->id_prog)->value('uraian');

        DB::table('ta_bansos')->insert([
          'uraian'  => $req->uraian,
          'tahun'   => $req->tahun,
          'id_sd'   => $req->id_sd,
          'uraian_sd' => $sd,
          'id_prog'   => $req->id_prog,
          'uraian_prog' => $prog,
          'created_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
          'updated_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
        ]);

        return ['error'=>0,'pesan'=>'Tambah Data Berhasil','data'=>self::GetDatas()];
    }

    static function EditData($url,$req){
        if(\Request::isMethod('POST')){
            $sd  = DB::table('ref_sumber_dana')->where('id',$req->id_sd)->value('uraian');
            $prog  = DB::table('ref_program')->where('id',$req->id_prog)->value('uraian');
            DB::table('ta_bansos')->where('id',$req->id)->update([
              'uraian'   => $req->uraian,
              'tahun'   => $req->tahun,
              'id_sd'   => $req->id_sd,
              'uraian_sd' => $sd,
              'id_prog'   => $req->id_prog,
              'uraian_prog' => $prog,
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
              'uraian'  => $bansos->uraian,
              'id_sd' => $bansos->id_sd,
              'tahun' => $bansos->tahun,
              'id_prog' => $bansos->id_prog
            ];
            $error = 0; $pesan = '';
        }else{
            $error = 1; $data = ''; $pesan = 'Data Tidak Ditemukan';
        }
        return ['error'=>$error, 'pesan'=>$pesan, 'data'=>$data];
    }

    static function HapusData($req){
        if(\Request::isMethod('POST')){
            $cek = DB::table('ta_penerima')->where('id_bansos',$req->id)->count();
            if($cek){
                return ['error'=>1,'pesan'=>'Hapus Data Penerima Dahulu','data'=>self::GetDatas()];
            }
            $del = DB::table('ta_bansos')->where('id',$req->id)->delete();
            if($del) return ['error'=>0,'pesan'=>'Hapus Data Berhasil','data'=>self::GetDatas()];
            else return ['error'=>1,'pesan'=>'Hapus Data Gagal','data'=>self::GetDatas()];
        }
    }

    static function GetChartData(){
        $bansos = DB::table('ta_bansos')->get();
        foreach($bansos as $dat){
            $data[]  = [
              'id'  => $dat->id,
              'judul' => $dat->uraian
            ];
        }
        if(!sizeOf($bansos)) $data = '';

        return $data;

    }

    static function GetJenisBansos(){
        return DB::table('ref_jenis')->get();
    }

}
