<?php

// Auth::routes();

Route::group(['prefix'=>'/'], function() {
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index');
    Route::post('/get-header/{url}','HomeController@GetHeader');

    Route::get('/guzzle','GuzzleController@index');
    Route::post('/guzzle','GuzzleController@index');
});

Route::group(['prefix'=>'data','middleware'=>'api'], function() {
    Route::get('/','DataRouteController@index');
    Route::get('/{satu}','DataRouteController@IndexRouteSatu');
    Route::get('/{satu}/{dua}','DataRouteController@IndexRouteDua');
    Route::get('/{satu}/{dua}/{tiga}','DataRouteController@IndexRouteTiga');
    Route::post('/{satu}','DataRouteController@IndexRouteSatu');
    Route::post('/{satu}/{dua}','DataRouteController@IndexRouteDua');
    Route::post('/{satu}/{dua}/{tiga}','DataRouteController@IndexRouteTiga');
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
