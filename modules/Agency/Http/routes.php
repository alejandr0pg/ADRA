<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'admin/agencies', 'namespace' => 'Modules\Agency\Http\Controllers'], function()
{
    // Agency
    Route::get('/', 'AgencyController@index')->name('agency');
    Route::post('/store', 'AgencyController@store')->name('agency.store');
    Route::get('/update/{id}', 'AgencyController@edit')->name('agency.modify');
    Route::put('/update/{id}', 'AgencyController@update')->name('agency.update');
    Route::delete('/destroy/{id}', 'AgencyController@destroy')->name('agency.destroy');
    
    // Bank info
    Route::get('{agency_id}/treasury-info', 'AgencyController@getTreasuryInfo')->name('agency.treasury-info.index');
    Route::post('{agency_id}/treasury-info', 'AgencyController@storeTreasuryInfo')->name('agency.treasury-info.store');

    // Profile tab
    Route::get('profile-tab/bank-info', 'AgencyController@profileTabBankInfo')->name('admin.agency.bank-info.tab');
    Route::post('profile-tab/bank-info', 'AgencyController@profileTabBankInfoStore')->name('agency.bank-info.tab.store');
});
