<?php

Route::group(['middleware' => 'web', 'prefix' => 'tasks', 'namespace' => 'Modules\Tasks\Http\Controllers'], function()
{
    Route::get('/', 'TasksController@index');
});
