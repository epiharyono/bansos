<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use Str;

use App\Http\Controllers\ProfileController as Profile;

class ProfileRouteController extends Controller
{

    public function index(){
        return Profile::index();
    }

    public function IndexRouteSatu($url){
        if($url == 'get_style') return Profile::GetStyle();
        elseif($url == 'ddd') return Profile::RubahPassword();
        else{
            return $this->index();
        }
    }

    public function IndexRouteDua($satu,$dua, Request $req){
        if($satu == 'my_profile') return Profile::IndexMyProfile();
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
