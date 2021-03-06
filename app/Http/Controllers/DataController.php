<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class DataController extends Controller
{
    static function index(){
        $data['title']  = 'Halaman Utama Data Entri Bansos';
        return view('bansos',$data);
    }

    static function IndexPenduduk(){
        $data['title']  = 'Halaman Utama Data Entri';
        return view('index_penduduk',$data);
    }

    static function IndexMaster(){
        $data['title']  = 'Halaman Utama Data Entri Master';
        return view('index_master',$data);
    }

    static function getProfile(){

        return ['sa'];
    }

    static function IndexMyProfile(){
        $id  = Auth::id();
        $data  = DB::table('users')->where('id',$id)->first();
        if($data){
            $datas = [
              'id'  => $data->id,
              'name'  => $data->name,
            ];
        }else $datas = '';

        return $datas;
    }

    static function GetSumberDana(){
        $data  = DB::table('ref_sumber_dana')->where('status',1)->get();
        if(sizeOf($data)){
            foreach($data as $dat){
                $datas[] = [
                  'id'  => $dat->id,
                  'uraian'  => $dat->uraian,
                ];
            }
        }else $datas[] = [];

        return $datas;

    }

}
