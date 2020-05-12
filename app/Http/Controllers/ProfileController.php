<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    static function index(){
        $data['title']  = 'Halaman Utama Profile';
        return view('profile',$data);
    }
}
