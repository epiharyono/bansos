<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

use App\Http\Controllers\DataController as Data;
use App\Http\Controllers\PendudukController as Penduduk;
use App\Http\Controllers\PenerimaController as Penerima;
use App\Http\Controllers\WilayahController as Wilayah;
use App\Http\Controllers\BansosController as Bansos;
use App\Http\Controllers\MasterProgramController as MProgram;


class GetReferensiController extends Controller
{

      public function IndexRouteSatu($url){
          if($url == 'xx') return Data::getData();
          elseif($url == 'xx') return Data::getData();
          else{
              if(Auth::id() != 1) return redirect('/');
              return [
                'IndexRouteSatu ' => ''
              ];
          }
      }

      public function IndexRouteDua($satu,$dua, Request $req){
          if($satu == 'get-master-tahun') return $this->getRefTahun();

          else{
              if(Auth::id() != 1) return redirect('/');
              return [
                'IndexRouteDua ' => $satu.' - '.$dua
              ];
          }
      }

      public function IndexRouteTiga($satu,$dua,$tiga, Request $req){
          if($satu == '') return Bansos::ccc($dua);
          else{
              if(Auth::id() != 1) return redirect('/');
              return [
                'IndexRouteTiga' => $satu.' -- '.$dua.' -- '.$tiga
              ];
          }
      }

      static function getRefTahun(){
          $data  = DB::table('ref_tahun')->where('status',1)->get();
          foreach($data as $dat){
              $datas[]  = [
                'id'  => $dat->id,
                'tahun' => $dat->tahun,
              ];
          }
          if(!sizeOf($data)) $datas  = [];

          return $datas;
      }

}
