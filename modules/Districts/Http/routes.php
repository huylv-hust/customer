<?php

Route::group(['middleware' => 'web', 'prefix' => 'districts', 'namespace' => 'Modules\Districts\Http\Controllers'], function()
{
	Route::get('/', 'DistrictsController@index');
});