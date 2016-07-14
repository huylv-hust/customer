<?php namespace Modules\Cities\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class CitiesController extends Controller {
	
	public function index()
	{
		return view('cities::index');
	}
	
}