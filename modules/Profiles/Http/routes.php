<?php

Route::group(['middleware' => ['web', 'verifyToken'], 'prefix' => 'profile', 'namespace' => 'Modules\Profiles\Http\Controllers'], function()
{
	Route::get('/{token}', 'ProfilesController@index')->name('update_profile');
	Route::post('/{token}', 'ProfilesController@postProfile');
});

Route::group(['middleware' => ['web'], 'namespace' => 'Modules\Profiles\Http\Controllers'], function()
{
	Route::get('/thanks', 'ProfilesController@getThanks')->name('thanks');
	Route::post('/getDistricts', 'ProfilesController@getDistricts')->name('district');
	Route::post('/getTowns', 'ProfilesController@getTowns')->name('towns');
});

Route::group(['middleware' => ['web'], 'prefix' => 'admin', 'namespace' => 'Modules\Profiles\Http\Controllers\Admin'], function()
{
	Route::get('', 'ProfilesController@index')->name('admin_login');
	Route::post('', 'ProfilesController@postLogin');
	Route::get('/logout', 'ProfilesController@logout')->name('admin_logout');
});

Route::group(['middleware' => ['web','checkAdminLogin'], 'prefix' => 'admin', 'namespace' => 'Modules\Profiles\Http\Controllers\Admin'], function()
{
	Route::get('customers', 'ProfilesController@listCustomers')->name('list_customers');
	Route::get('profile/{id}', 'ProfilesController@detail')->name('detail_customers');
	Route::get('profile/edit/{id}', 'ProfilesController@edit')->name('edit_customers');
	Route::post('profile/edit/{id}', 'ProfilesController@postEdit');
});