<?php

use App\Http\Controllers\api\VPNController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v2-0-0'], function () {

    Route::get('/', function () {
        return "endpoint";
    });
    Route::group(['prefix' => 'allservers'], function () {
        Route::get('/', [VPNController::class, "allVPNServer"]);
        Route::get('/free',  [VPNController::class, "allVPNFreeServer"]);
        Route::get('/pro', [VPNController::class, "allVPNProServer"]);
    });


    Route::get('/detail/{id}',  [VPNController::class, "detailVpn"]);
    Route::get('/detail/random',  [VPNController::class, "randomVpn"]);

    //  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ //
    Route::middleware([ApiValid::class])->group(function () {
        Route::get('user/',[UserController::class, "all"]);
        Route::get('user/{email}',[UserController::class, "get"]);
        Route::post('user',[UserController::class, "save"]);
        Route::post('emailCheckCode',[UserController::class, "emailCheckCode"]);
        //login
        Route::get('login',[UserController::class, "login"]);
    });

});
