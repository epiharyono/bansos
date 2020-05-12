<?php

Auth::routes();

Route::group(['prefix'=>'/'], function() {
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index');
});

Route::group(['prefix'=>'profile','middleware'=>'api'], function() {
    Route::get('/','ProfileRouteController@index');
    Route::get('/{satu}','ProfileRouteController@IndexRouteSatu');
    Route::get('/{satu}/{dua}','ProfileRouteController@IndexRouteDua');
    Route::get('/{satu}/{dua}/{tiga}','ProfileRouteController@IndexRouteTiga');
    Route::post('/{satu}','ProfileRouteController@IndexRouteSatu');
    Route::post('/{satu}/{dua}','ProfileRouteController@IndexRouteDua');
    Route::post('/{satu}/{dua}/{tiga}','ProfileRouteController@IndexRouteTiga');
});
