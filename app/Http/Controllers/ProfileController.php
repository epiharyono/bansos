<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ProfileController extends Controller
{
    static function index(){
        $data['title']  = 'Halaman Utama Profile';
        return view('profile',$data);
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
              'email'  => $data->email,
              'about_me'  => $data->about_me,
            ];
        }else $datas = '';

        return $datas;
    }

    static function EditDataProfile($req){
        $id  = Auth::id();
        DB::table('users')->where('id',$id)->update([
          'name'  => $req->name,
          'email' => $req->email,
          'about_me'  => $req->about_me,
        ]);
        return ['error'=>0,'pesan'=>'UPdate Profile Berhasil'];
    }
}
