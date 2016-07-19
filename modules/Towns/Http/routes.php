<?php

Route::group(['middleware' => ['web','checkAdminLogin'], 'prefix' => 'admin/towns', 'namespace' => 'Modules\Towns\Http\Controllers\Admin'], function()
{
	Route::get('/', 'TownsController@index')->name('list_town');
	Route::get('/create', 'TownsController@getCreate')->name('create_town');
	Route::post('/create', 'TownsController@postCreate');
	Route::get('/edit/{id}', 'TownsController@getEdit')->name('edit_town');
	Route::post('/edit/{id}', 'TownsController@postEdit');
	Route::post('/delete', 'TownsController@postDelete');
});