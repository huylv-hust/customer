<?php

Route::group(['middleware' => ['web','checkAdminLogin'], 'prefix' => 'admin/cities', 'namespace' => 'Modules\Cities\Http\Controllers\Admin'], function()
{
	Route::get('/', 'CitiesController@index')->name('list_city');
	Route::get('/create', 'CitiesController@getCreate')->name('create_city');
	Route::post('/create', 'CitiesController@postCreate');
	Route::get('/edit/{id}', 'CitiesController@getEdit')->name('edit_city');
	Route::post('/edit/{id}', 'CitiesController@postEdit');
	Route::post('/delete', 'CitiesController@postDelete');
	Route::get('/import', 'CitiesController@importData')->name('import_data');
	Route::post('/import', 'CitiesController@importData');
});

Route::group(['middleware' => ['web','checkAdminLogin'], 'prefix' => 'admin/', 'namespace' => 'Modules\Cities\Http\Controllers\Admin'], function()
{
	Route::get('/import', 'CitiesController@getImport')->name('import_data');
	Route::post('/import', 'CitiesController@postImport');
});