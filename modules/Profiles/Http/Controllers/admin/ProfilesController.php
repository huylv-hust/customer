<?php namespace Modules\Profiles\Http\Controllers\Admin;

use App\Email;
use App\Helpers\Constant;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Pingpong\Modules\Routing\Controller;

class ProfilesController extends Controller {

	public function index()
	{
		return view('profiles::login');
	}

	public function postLogin(Request $request)
	{
		$input = $request->all();
		if ($input['user'] == Constant::$user['user'] && $input['password'] == Constant::$user['password']) {
			Session::set('user', ['user' => $input['user']]);
			return redirect()->route('list_customers');
		}

		Session::flash('error', 'error');

		return redirect()->back()->withInput();
	}

	public function listCustomers(Request $request)
	{
		$profile = new Profile();
		$data['profiles'] = $profile->getList($request->all());
		$data['filter'] = $request->all();

		return view('profiles::list', $data);
	}

	public function detail($id)
	{
		if(!$id || !$data['profile'] = Profile::find($id))
		{
			return redirect()->route('list_customers');
		}
		$data['email'] = Email::find($data['profile']->email_id);
		return view('profiles::detail', $data);
	}
}