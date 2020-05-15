<?php

use Illuminate\Http\Request;


Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', 'Auth\JwtAuthController@register');
        Route::post('login', 'Auth\JwtAuthController@authenticate');
        Route::middleware('jwt.verify')->group(function () {
            Route::get('user', 'Auth\JwtAuthController@getAuthenticatedUser');
            Route::post('logout', 'Auth\JwtAuthController@logout');
        });
    });

    Route::group(['prefix'=>'profile','middleware'=>'jwt'], function() {
        Route::get('/','ProfileRouteController@index');
        Route::get('/{satu}','ProfileRouteController@IndexRouteSatu');
        Route::get('/{satu}/{dua}','ProfileRouteController@IndexRouteDua');
        Route::get('/{satu}/{dua}/{tiga}','ProfileRouteController@IndexRouteTiga');
        Route::post('/{satu}','ProfileRouteController@IndexRouteSatu');
        Route::post('/{satu}/{dua}','ProfileRouteController@IndexRouteDua');
        Route::post('/{satu}/{dua}/{tiga}','ProfileRouteController@IndexRouteTiga');
    });

    Route::group(['prefix'=>'data','middleware'=>'jwt'], function() {
        Route::get('/','DataRouteController@index');
        Route::get('/{satu}','DataRouteController@IndexRouteSatu');
        Route::get('/{satu}/{dua}','DataRouteController@IndexRouteDua');
        Route::get('/{satu}/{dua}/{tiga}','DataRouteController@IndexRouteTiga');
        Route::post('/{satu}','DataRouteController@IndexRouteSatu');
        Route::post('/{satu}/{dua}','DataRouteController@IndexRouteDua');
        Route::post('/{satu}/{dua}/{tiga}','DataRouteController@IndexRouteTiga');
    });

    Route::group(['prefix'=>'guest'], function() {
        Route::get('/','DataRouteController@index');
        Route::get('/{satu}','DataRouteController@IndexRouteSatu');
        Route::get('/{satu}/{dua}','DataRouteController@IndexRouteDua');
        Route::get('/{satu}/{dua}/{tiga}','DataRouteController@IndexRouteTiga');
        Route::post('/{satu}','DataRouteController@IndexRouteSatu');
        Route::post('/{satu}/{dua}','DataRouteController@IndexRouteDua');
        Route::post('/{satu}/{dua}/{tiga}','DataRouteController@IndexRouteTiga');
    });

});
