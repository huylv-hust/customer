<?php namespace Modules\Districts\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class DistrictsController extends Controller {
	
	public function index()
	{
		return view('districts::index');
	}
	
}