<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'admin/emergencies', 'namespace' => 'Modules\Emergency\Http\Controllers'], function() {
    Route::delete('{id}/delete', 'EmergencyController@destroy')->name('emergency.destroy');
    Route::put('{id}/update', 'EmergencyController@update')->name('emergency.update');
    Route::get('{id}/update', 'EmergencyController@modify')->name('emergency.modify');
    Route::get('/{id}', 'EmergencyController@dashboard')->name('emergency.dashboard');
    Route::post('store', 'EmergencyController@store')->name('emergency.store');
    Route::get('/', 'EmergencyController@index')->name('emergency.index');

    Route::get('{emergency}/sitrep', 'EmergencyController@sitrep')->name('emergency.dashboard.sitrep');
    Route::get('{emergency}/sitrep/{id}/pdf', 'EmergencyController@showPDF')->name('emergency.dashboard.sitrep.pdf');
    Route::post('{emergency}/sitrep', 'EmergencyController@sitrepStore')->name('emergency.dashboard.sitrep.store');

    Route::post('{emergency}/sitrep/agregateInfoDestacated', 'EmergencyController@sitrepAddInfo')->name('emergency.dashboard.sitrep.add-info');
    Route::delete('{emergency}/sitrep/{sitrep}/infoDestacated', 'EmergencyController@sitrepInfoDelete')->name('emergency.dashboard.sitrep.delete-info');

    Route::post('toggle-task', 'EmergencyController@toggleTask')->name('emergency.dashboard.task.toggle');

    Route::post('upload-doc', 'EmergencyController@uploadDocument')->name('emergency.dashboard.upload.doc');
    Route::delete('delete-document/{id}', 'EmergencyController@deleteDocument')->name('emergency.dashboard.delete.doc');
    Route::delete('delete-picture/{id}', 'EmergencyController@deletePicture')->name('emergency.dashboard.delete.picture');
    Route::post('upload-img', 'EmergencyController@uploadPicture')->name('emergency.dashboard.upload.pic');
    
    Route::post('budget-store', 'EmergencyController@budgetStore')->name('emergency.dashboard.budget-store');
    Route::delete('{emergency}/budget-delete/{id}', 'EmergencyController@budgetDelete')->name('emergency.dashboard.budget-delete');
    //Route::get('budget-detail', 'EmergencyController@budgetDetail')->name('emergency.dashboard.budget-detail');

    Route::post('expenditure-store', 'EmergencyController@expenditureStore')->name('emergency.dashboard.expenditure-store');
    Route::delete('{emergency}/expenditure-delete/{id}', 'EmergencyController@expenditureDelete')->name('emergency.dashboard.expenditure-delete');
    //Route::get('expenditure-detail', 'EmergencyController@expenditureDetail')->name('emergency.dashboard.expenditure-detail');

});


Route::group(['middleware' => ['web','auth'], 'prefix' => 'admin/settings', 'namespace' => 'Modules\Emergency\Http\Controllers'], function() {
    Route::get('events-types/', 'EventTypeController@index')->name('events-types.index');
    Route::post('events-types/store', 'EventTypeController@store')->name('events-types.store');
    Route::get('events-types/{id}/update', 'EventTypeController@modify')->name('events-types.modify');
    Route::put('events-types/{id}/update', 'EventTypeController@update')->name('events-types.update');
    Route::delete('events-types/{id}/delete', 'EventTypeController@destroy')->name('events-types.destroy');

    Route::get('contributions/', 'ContributionsController@index')->name('contributions.index');
    Route::post('contributions/store', 'ContributionsController@store')->name('contributions.store');
    Route::get('contributions/{id}/update', 'ContributionsController@modify')->name('contributions.modify');
    Route::put('contributions/{id}/update', 'ContributionsController@update')->name('contributions.update');
    Route::delete('contributions/{id}/delete', 'ContributionsController@destroy')->name('contributions.destroy');
});
