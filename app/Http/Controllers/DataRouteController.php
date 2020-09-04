<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use Str;

use App\Http\Controllers\DataController as Data;
use App\Http\Controllers\PendudukController as Penduduk;
use App\Http\Controllers\PenerimaController as Penerima;
use App\Http\Controllers\WilayahController as Wilayah;
use App\Http\Controllers\BansosController as Bansos;
use App\Http\Controllers\MasterProgramController as MProgram;

class DataRouteController extends Controller
{

    public function index(){
        return Data::index();
    }

    public function IndexRouteSatu($url){
        if($url == 'xx') return Data::getData();
        elseif($url == 'xx') return Data::getData();
        else{
            return $this->index();
        }
    }

    public function IndexRouteDua($satu,$dua, Request $req){
        if($satu == 'entri-bansos') return Data::index();
        elseif($satu == 'entri-penduduk') return Data::IndexPenduduk();
        elseif($satu == 'tambah-data-penduduk') return Penduduk::TambahDataPenduduk($req);
        elseif($satu == 'get-data-penduduk') return Penduduk::GetDatas();

        elseif($satu == 'get-data-sumber-dana') return Data::GetSumberDana();
        elseif($satu == 'entri-master-program') return Data::IndexMaster();
        elseif($satu == 'get-data-master-program') return MProgram::GetDataMasterProgram();
        elseif($satu == 'get-data-master-program-sumber-dana') return MProgram::GetDataMasterProgramSD($req);
        elseif($satu == 'tambah-data-master-program') return MProgram::TambahDataMaterProgram($req);
        elseif($satu == 'edit-data-master-program') return MProgram::EditDataMaterProgram($dua,$req);
        elseif($satu == 'hapus-data-master-program') return MProgram::HapusDataMaterProgram($req);

        elseif($satu == 'get-data-provinsis') return Wilayah::getDataProvinsis();
        elseif($satu == 'get-data-kabupatens') return Wilayah::getDataKabupatens($req);
        elseif($satu == 'get-data-kecamatans') return Wilayah::getDataKecamatans($req);
        elseif($satu == 'get-data-desas') return Wilayah::getDataDesas($req);

        elseif($satu == 'tambah-data-bansos') return Bansos::TambahData($req);
        elseif($satu == 'get-data-bansos') return Bansos::GetDatas();
        elseif($satu == 'edit-data-bansos') return Bansos::EditData($dua,$req);
        elseif($satu == 'hapus-data-bansos') return Bansos::HapusData($req);

        elseif($satu == 'get-jenis-bansos') return Bansos::GetJenisBansos();
        elseif($satu == 'get-bansos-detail') return Bansos::GetData($dua);
        elseif($satu == 'get-chart-bansos') return Bansos::GetChartData();

        elseif($satu == 'tambah-data-penerima-bansos') return Penerima::TambahData($req);
        elseif($satu == 'get-data-penerima-bansos') return Penerima::GetDatas($dua);
        elseif($satu == 'hapus-data-penerima-bansos') return Penerima::HapusData($req);

        elseif($satu == 'check-nik') return Penduduk::CheckNIK($dua);
        elseif($satu == 'cek-penerima-bansos') return Penerima::guestCekPenerimaBansos($req);

        else{
            if(Auth::id() != 1) return redirect('/');
            return 'IndexRouteDua '.$satu.' - '.$dua;
        }
    }

    public function IndexRouteTiga($satu,$dua,$tiga, Request $req){
        if($satu == '') return Bansos::ccc($dua);
        elseif($satu == 'entri-bansos') return Bansos::IndexDetail($dua);
        elseif($satu == 'xxxxxxx' && $dua == 'debt_pay'){
            return ApiTransactionController::PaymentPayLater($tiga);
        }else{
            if(Auth::id() != 1) return redirect('/');
            return 'IndexRouteTiga '.$satu.' -- '.$dua.' -- '.$tiga;
        }
    }
}
