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
}
