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
        if($url == 'profile') return Profile::getProfile();
        elseif($url == 'ddd') return Profile::getProfile();
        else{
            return $this->index();
        }
    }

    public function IndexRouteDua($satu,$dua, Request $req){
        if($satu == 'get-data') return Profile::IndexMyProfile();
        elseif($satu == 'edit-data') return Profile::EditDataProfile($req);
        elseif($satu == 'update-passwd') return Profile::UpdatePassword($req);
        elseif($satu == 'is-login') return Profile::isLogin();
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
