<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin/planification', 'namespace' => 'Modules\CorePlanification\Http\Controllers'], function() {

    Route::get('/', 'CorePlanificationController@register');
    //lineas
    Route::get('/register', 'RegisterController@index');
    Route::get('/register/{id}/edit', 'RegisterController@edit');
    Route::post('/register', 'RegisterController@store')->name('line_register.store');
    Route::put('/register', 'RegisterController@update')->name('line_register.update');
    Route::delete('/register', 'RegisterController@delete')->name('line_register.delete');

    //objetivos
     Route::post('/register/objetivo', 'RegisterController@objetivos_store')->name('objetivo_register.store');
     //objetivos
     Route::post('/register/objetivo', 'RegisterController@objetivos_store')->name('objetivo_register.store');

  	Route::post('/register/objetivo/delete', 'RegisterController@delete_objetivo')->name('objetivo_register.delete');

    //indicadores
     Route::post('/register/indicador', 'RegisterController@indicador_store')->name('indicador_register.store');
     Route::post('ejecuter/indicador/update', 'EjecuterController@indicador_core_update')->name('indicador_core_update');

     
    Route::post('/register/indicador/delete', 'RegisterController@delete_indicador')->name('indicador_register.delete');

        //documentos
     Route::post('/register/document', 'RegisterController@document_store')->name('indicador_document.store');
     
    Route::post('/register/document/delete', 'RegisterController@delete_document')->name('indicador_document.delete');


        //mensajes
     Route::post('/mensaje/send', 'EjecuterController@mensaje_store')->name('mensaje_send.store');
     
    Route::post('/mensaje/delete', 'EjecuterController@mensaje_delete')->name('mensaje.delete');

        



    Route::get('/ejecuter', 'EjecuterController@index');

    Route::get('/evaluation','EvaluationController@index');

    Route::get('indicator-advance', 'IndicatorAdvanceController@index');

    Route::get('advance-ivo','AdvanceIvoController@index');
});
