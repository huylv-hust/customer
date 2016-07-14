<?php

Route::group(['middleware' => 'web', 'prefix' => 'cities', 'namespace' => 'Modules\Cities\Http\Controllers'], function()
{
	Route::get('/', 'CitiesController@index');
});