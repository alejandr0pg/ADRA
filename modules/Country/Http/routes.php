<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'admin/settings/country', 'namespace' => 'Modules\Country\Http\Controllers'], function() {
	//
    Route::get('/', 'CountryController@index')->name('countries.index');
    Route::post('/store', 'CountryController@store')->name('countries.store');
    Route::get('/update/{id}', 'CountryController@modify')->name('countries.modify');
    Route::put('/update/{id}', 'CountryController@update')->name('countries.update');
    Route::delete('/destroy/{id}', 'CountryController@destroy')->name('countries.destroy');
});
