<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use Str;

use App\Http\Controllers\DataController as Data;

class DataRouteController extends Controller
{

    public function index(){
        return Data::index();
    }

    public function IndexRouteSatu($url){
        if($url == 'profile') return Data::getData();
        elseif($url == 'ddd') return Data::getData();
        else{
            return $this->index();
        }
    }

    public function IndexRouteDua($satu,$dua, Request $req){
        if($satu == 'get-data') return Data::IndexMyData();
        elseif($satu == 'get_my_profile') return Profile::GetMyProfile();
        elseif($satu == 'update_my_profile') return Profile::UpdateMyProfile($req);
        elseif($satu == 'rubah_password') return Profile::RubahPassword($req);
        elseif($satu == 'update_my_passwd') return Profile::RubahPassword($req);
        else{
            if(Auth::id() != 1) return redirect('/');
            return 'IndexRouteDua '.$satu.' - '.$dua;
        }
    }

    public function IndexRouteTiga($satu,$dua,$tiga, Request $req){
        if($satu == 'xxxxxxx' && $dua == 'data_menu'){
            return ApiMenuController::VueGetDataMenuRestoran();
        }elseif($satu == 'xxxxxxx' && $dua == 'debt_pay'){
            return ApiTransactionController::PaymentPayLater($tiga);
        }else{
            if(Auth::id() != 1) return redirect('/');
            return 'IndexRouteTiga '.$satu.' -- '.$dua.' -- '.$tiga;
        }
    }
}
