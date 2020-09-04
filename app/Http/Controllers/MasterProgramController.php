<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Str;

class MasterProgramController extends Controller
{
    static function GetDataMasterProgram(){
        $data  = DB::table('ref_program as prog')->join('ref_sumber_dana as sd','sd.id','prog.id_sd')
                 ->select('prog.*','sd.uraian as sumber_dana')->get();
        foreach($data as $dat){
            $datas[]  = [
              'id'  => $dat->id,
              'uraian'  => $dat->uraian,
              'sumber'  => $dat->sumber_dana,
            ];
        }
        if(!sizeOf($data)) $datas[] = [];

        return [
          'authr' => 1,
          'status'=> 1,
          'data'  => $datas
        ];
    }

    static function TambahDataMaterProgram($req){
        $user  = Auth::user();
        $inst  = DB::table('ref_program')->insert([
            'id_sd' => $req->id_sd,
            'uraian'  => $req->uraian,
            'created_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
            'updated_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
        ]);
        if($inst){
            $error = 0;
            $pesan = 'Sukses Tambah Master Program';
        }else{
            $error = 1;
            $pesan = 'Gagal Tambah Master Program';
        }
        return [
          'error' => $error,
          'pesan' => $pesan,
          'data' => self::GetDataMasterProgram()
        ];
    }

    static function EditDataMaterProgram($url,$req){
        if(\Request::isMethod('POST')){
            DB::table('ref_program')->where('id',$req->id)->update([
              'id_sd'  => $req->id_sd,
              'uraian'   => $req->uraian,
              'updated_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
            ]);
            return ['error'=>0,'pesan'=>'Edit Data Berhasil','data'=>self::GetDataMasterProgram()];
        }

        $split  = explode("-", $url);
        $id     = $split[0];
        $dat = DB::table('ref_program')->where('id',$id)->first();
        if($dat){
            $data = [
              'id'  => $dat->id,
              'id_sd' => $dat->id_sd,
              'uraian'  => $dat->uraian,
            ];
            $error = 0; $pesan = '';
        }else{
            $error = 1; $data = ''; $pesan = 'Data Tidak Ditemukan';
        }
        return ['error'=>$error, 'pesan'=>$pesan, 'data'=>$data];

    }

    static function HapusDataMaterProgram($req){
        if(\Request::isMethod('POST')){
            $del = DB::table('ref_program')->where('id',$req->id)->delete();
            if($del) return ['error'=>0,'pesan'=>'Hapus Data Berhasil','data'=>self::GetDataMasterProgram()];
            else return ['error'=>1,'pesan'=>'Hapus Data Gagal','data'=>self::GetDataMasterProgram()];
        }
    }

    static function GetDataMasterProgramSD($req){
        $data  = DB::table('ref_program')->where('id_sd',$req->id_sd)->orderBy('id')->get();
        foreach($data as $dat){
            $datas[]  = [
              'id'    => $dat->id,
              'uraian'  => $dat->uraian,
            ];
        }
        if(!sizeOf($data)) $datas  = [];
        return $datas;
    }

}
