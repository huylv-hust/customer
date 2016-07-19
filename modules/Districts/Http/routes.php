<?php

Route::group(['middleware' => ['web','checkAdminLogin'], 'prefix' => 'admin/districts', 'namespace' => 'Modules\Districts\Http\Controllers\Admin'], function()
{
	Route::get('/', 'DistrictsController@index')->name('list_district');
	Route::get('/create', 'DistrictsController@getCreate')->name('create_district');
	Route::post('/create', 'DistrictsController@postCreate');
	Route::get('/edit/{id}', 'DistrictsController@getEdit')->name('edit_district');
	Route::post('/edit/{id}', 'DistrictsController@postEdit');
	Route::post('/delete', 'DistrictsController@postDelete');
});