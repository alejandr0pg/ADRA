<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'admin/donors', 'namespace' => 'Modules\Donors\Http\Controllers'], function()
{
    Route::get('/', 'DonorsController@index')->name('donors.index');
    Route::post('/store', 'DonorsController@store')->name('donors.store');
    Route::get('/update/{id}', 'DonorsController@edit')->name('donors.modify');
    Route::put('/update/{id}', 'DonorsController@update')->name('donors.update');
    Route::delete('/destroy/{id}', 'DonorsController@destroy')->name('donors.destroy');
});
