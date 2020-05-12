<?php

use Illuminate\Http\Request;


Route::group(['prefix'=>'profile','middleware'=>'jwt'], function() {
    Route::get('/','ProfileRouteController@index');
    Route::get('/{satu}','ProfileRouteController@IndexRouteSatu');
    Route::get('/{satu}/{dua}','ProfileRouteController@IndexRouteDua');
    Route::get('/{satu}/{dua}/{tiga}','ProfileRouteController@IndexRouteTiga');
    Route::post('/{satu}','ProfileRouteController@IndexRouteSatu');
    Route::post('/{satu}/{dua}','ProfileRouteController@IndexRouteDua');
    Route::post('/{satu}/{dua}/{tiga}','ProfileRouteController@IndexRouteTiga');
});
