<?php

use App\Http\Controllers\VisitanteController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::apiResource('visitante', VisitanteController::class);
    });

    Route::group(['prefix' => 'visitantes'], function () {
        Route::post('register', [VisitanteController::class, 'registrar']);
        Route::post('verificar/email', [VisitanteController::class, 'verificarCorreo'])
          ->middleware('email.confirmar');
          Route::post('reenviar/verificar/email', [VisitanteController::class, 'reenviarCorreoVerificacion']);
    });
});
