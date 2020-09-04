<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class GuzzleController extends Controller
{
    private $url;

    public function __construct()
    {
        $this->url = 'http://172.10.60.27/api/';
    }

    static function index(){
      // return config('global.url');
      $url  = config('global.url').'guzzle';
      $client = new \GuzzleHttp\Client();
      // $request = $client->get($url);
      // $response = $request->getBody();


      $myBody['name'] = "sha";
      $myBody['nik'] = "123";
      $request = $client->post($url,  ['form_params'=>$myBody]);
      // $response = $request->send();

        // return 'index';
      return $request->getBody();
    }

    static function Resp(Request $req){
        if(\Request::isMethod('POST')){
            return ['pesan'=>'Method POST','data'=>$req->all()];
        }

        return ['pesan'=>'Method Get'];
    }

}
