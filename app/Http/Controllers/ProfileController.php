<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
              'isLogin' => 1
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

    static function UpdatePassword($req){
        if(\Request::isMethod('POST')){
            $old  = $req->old;
            $new  = $req->new;
            $confirm  = $req->conf;
            if($new != $confirm){
                return ['error'=>1, 'pesan'=>'Confirmasi Password Salah'];
            }else{
                $pass = Hash::make($old);
                if (Auth::attempt(array('email' => Auth::user()->email, 'password' => $old))){
                    if(Auth::check()){
                        DB::table('users')->where('id',Auth::id())->update([
                          'password'  => Hash::make($new),
                        ]);
                        $pesan  = 'Password Berhasil Diupdate';
                        $error  = 0;
                    }else{
                        $pesan  = 'Update Password Gagal, Data Tidak Ditemukan';
                        $error  = 1;
                    }
                }else{
                    $pesan  = 'Update Password Gagal, Data Tidak Ditemukan';
                    $error  = 1;
                }
                return ['error'=>$error, 'pesan'=>$pesan];
            }
        }
    }

    static function isLogin(){
        if(Auth::check()){
            $lgoin  = 1;
        }else{
            $login  = 0;
        }
        $login  = Auth::id();
        return ['isLogin' => $login];
    }

}
