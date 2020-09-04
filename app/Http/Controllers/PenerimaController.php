<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use File;
use Storage;

class PenerimaController extends Controller
{

    static function GetDatas($url){
        $split  = explode("-", $url);
        $id_bansos    = $split[0]; $no = 1;
        $data  = DB::table('ta_penerima as penerima')->join('ref_jenis as jenis','jenis.id','penerima.id_jenis')
                 ->select('penerima.*','jenis.uraian as nm_jenis')->where('penerima.id_bansos',$id_bansos)->orderBy('id','DESC')->get();
        foreach($data as $dat){
            $nm_kec   = strtolower($dat->nm_kec);
            $nm_desa  = strtolower($dat->nm_desa);
            $datas[]  = [
              'no'    => $no,
              'id'    => $dat->id,
              'nama'  => $dat->nama,
              'nik'   => $dat->nik,
              'id_jenis'   => $dat->id_jenis,
              'keterangan'   => $dat->keterangan,
              'alamat'  => $dat->alamat,
              'nm_jenis'  => $dat->nm_jenis
            ];
            $no++;
        }
        if(!sizeOf($data)) $datas  = '';
        return ['authr'=>1, 'data'=>$datas];
    }

    static function TambahData($req){
        $cek  = DB::table('ta_penduduk')->where('nik',$req->nik)->where('id',$req->id_pend)->first();
        if($cek){
            $cekp = DB::table('ta_penerima')->where('id_jenis',$req->id_jenis)->where('nik',$cek->nik)->count();
            if($cekp) return  ['error'=>1,'pesan'=>'Gagal Tambah Data, Penerima dan Jenis Double','data'=>self::GetDatas($req->id_bansos.'-caribansos')];

            $nm_prov  = DB::table('ref_provinces')->where('id',$cek->id_prov)->value('name');
            $nm_kab   = DB::table('ref_regencies')->where('id',$cek->id_kab)->value('name');
            $nm_kec   = DB::table('ref_districts')->where('id',$cek->id_kec)->value('name');
            $nm_desa  = DB::table('ref_villages')->where('id',$cek->id_desa)->value('name');
            if($req->id_jenis == 1) $blt  = $req->uang;
            else $blt = 0;
            $id_table  = DB::table('ta_penerima')->insertGetId([
              'id_bansos'  => $req->id_bansos,
              'id_jenis'  => $req->id_jenis,
              'blt'  => $blt,
              'keterangan'  => $req->keterangan,
              'nama'  => $cek->nama,
              'nik'   => $cek->nik,
              'tempat'   => $cek->tempat,
              'tanggal'   => $cek->tanggal,
              'id_prov'   => $cek->id_prov,
              'id_kab'   => $cek->id_kab,
              'id_kec'   => $cek->id_kec,
              'id_desa'   => $cek->id_desa,
              'nm_prov'   => $nm_prov,
              'nm_kab'   => $nm_kab,
              'nm_kec'   => $nm_kec,
              'nm_desa'   => $nm_desa,
              'alamat'  => $cek->alamat,
              'created_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
              'updated_by'  => json_encode(['id'=>Auth::id(), 'name'=>Auth::user()->name,'email'=>Auth::user()->email]),
            ]);

            if(isset($req->files)){
                $jml = $req->jmlF;
                for($i=0; $i < $jml; $i++){
                  foreach ($req->files as $file) {
                      $mime  = File::mimeType($file[$i]);
                      $fileName = date('Ymdhis').'.'.$file[$i]->getClientOriginalExtension();
                      $resume = $file[$i];
                      $filePath = Storage::disk('s3')->putFileAs(
                          'files',
                          $resume,
                          $fileName,
                          [ 'visibility' => 'public' ]
                      );
                      DB::table('ta_penerima_files')->insert([
                        'id_pen'  => $id_table,
                        'name'    => $fileName,
                        'path'    => $filePath,
                        'mime'    => $mime,
                      ]);
                      sleep(1);
                  }
                }
            }
        }

        return ['error'=>0,'pesan'=>'Tambah Data Berhasil','data'=>self::GetDatas($req->id_bansos.'-caribansos')];
    }

    static function HapusData($req){
        $penerima  = DB::table('ta_penerima')->where('id',$req->id)->first();
        if($penerima){
            $id_bansos = $penerima->id_bansos;
            if($penerima->status){
                return ['error'=>1,'pesan'=>'Gagal Hapus Data, Data Sudah Final','data'=>''];
            }
            $file  = DB::table('ta_penerima_files')->where('id_pen',$penerima->id)->get();
            foreach($file as $df){
                Storage::disk('s3')->delete($df->path);
            }
            DB::table('ta_penerima_files')->where('id_pen',$penerima->id)->delete();
            DB::table('ta_penerima')->where('id',$penerima->id)->delete();
            return ['error'=>0,'pesan'=>'Data Berhasil Dihapus','data'=>self::GetDatas($id_bansos.'-caribansos')];
        }else{
            return ['error'=>1,'pesan'=>'Data Tidak Ditemukan','data'=>''];
        }

    }

    static function guestCekPenerimaBansos($req){
        $penerima  = DB::table('ta_penerima as penerima')->join('ref_jenis as jenis','jenis.id','penerima.id_jenis')
                    ->select('penerima.*','jenis.uraian as nm_jenis')->where('penerima.nik',$req->nik)->get();
        if(sizeOf($penerima)){
            $no = 1;
            foreach($penerima as $dat){
                $data[]  = [
                  'no'  => $no,
                  'id'  => $dat->id,
                  'nama'  => $dat->nama,
                  'nik' => $dat->nik,
                  'alamat'  => $dat->alamat,
                  'jenis' => $dat->id_jenis,
                  'keterangan'  => $dat->keterangan,
                  'nm_jenis'  => $dat->nm_jenis
                ];
                $no++;
            }

            return ['error'=>0,'pesan'=>'','data'=>$data];
        }else{
            return ['error'=>1,'pesan'=>'Data Tidak Ditemukan '.$req->nik,'data'=>''];
        }


        return $req->nik;
    }

}
