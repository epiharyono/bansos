<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['title']  = 'Haalaman Utama bansos';
        return view('home',$data);
    }

    public function GetHeader($url,Request $req){

        return ['nav'=>self::getNavbrand($req->url)];
    }

    static function getNavbrand($url){
        $arr = explode("/", $url);
        $brand = sizeOf($arr).' - '.$url;
        // return $brand;
        if(sizeOf($arr) == 1 || sizeOf($arr) == 2) $brand  = 'Dashboard';
        elseif(sizeOf($arr) == 3){
            if($arr[1] == 'profile') $brand = 'Data Profile';
            else $brand = $arr[1];
        }elseif(sizeOf($arr) == 4){
            if($arr[1] == 'data' && $arr[2] == 'entri') $brand = 'Data Entri';
            elseif($arr[2] == 'ss') $brand = 'Data Profile';
            else $brand = $arr[2];
        }elseif(sizeOf($arr) == 5){
            if($arr[2] == 'fdsa') $brand = 'Data Umum Sekolah';
            elseif($arr[2] == 'ulangan-online') $brand = 'Rincian Ulangan Online';
            elseif($arr[2] == 'diskusi-online') $brand = 'Rincian Diskusi Online';
            else $brand = $arr[2];
        }

        return $brand;
    }

}
