<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class WilayahController extends Controller
{

    static function getDataProvinsis(){
        $data  = DB::table('ref_provinces')->orderBy('name')->get();
        foreach($data as $dat){
            $datas[]  = [
              'id'    => $dat->id,
              'name'  => $dat->name,
            ];
        }
        if(!sizeOf($data)) $datas  = '';
        return $datas;
    }

    static function getDataKabupatens($req){
        $data  = DB::table('ref_regencies')->where('province_id',$req->id_prov)->orderBy('id')->get();
        foreach($data as $dat){
            $datas[]  = [
              'id'    => $dat->id,
              'name'  => $dat->name,
            ];
        }
        if(!sizeOf($data)) $datas  = '';
        return $datas;
    }

    static function getDataKecamatans($req){
        $data  = DB::table('ref_districts')->where('regency_id',$req->id_kab)->orderBy('id')->get();
        foreach($data as $dat){
            $datas[]  = [
              'id'    => $dat->id,
              'name'  => $dat->name,
            ];
        }
        if(!sizeOf($data)) $datas  = '';
        return $datas;
    }

    static function getDataDesas($req){
        $data  = DB::table('ref_villages')->where('district_id',$req->id_kec)->orderBy('id')->get();
        foreach($data as $dat){
            $datas[]  = [
              'id'    => $dat->id,
              'name'  => $dat->name,
            ];
        }
        if(!sizeOf($data)) $datas  = '';
        return $datas;
    }

}
