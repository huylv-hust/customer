<?php namespace Modules\Profiles\Http\Controllers\Admin;

use App\City;
use App\District;
use App\Email;
use App\Helpers\Constant;
use App\Profile;
use App\Town;
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
		if(isset($request['export']) && $request['export'] == 1) {
			$this->export($request);
		}
		$profile = new Profile();
		$data['profiles'] = $profile->getList($request->all());
		$data['filter'] = $request->all();
		$query_string = empty($data['filters']) ? '' : '?' . http_build_query($data['filters']);
		$request->session()->put('list_customers_url', $request->url() . $query_string);

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

	public function edit(City $city, District $district, Town $town, $id)
	{
		$data['title'] = 'Edit Customer';
		$data['url'] = route('edit_customers', ['id' => $id]);
		if (!Profile::where('deleted_at', null)->where('id', $id)->first())
		{
			return redirect()->route('list_customers');
		}
		$data['profile'] = Profile::find($id);
		$data['cities'] = $city->getAllCity();
		$data['districts'] = $district->getDistricts($data['profile']->address_1);
		$data['towns'] = $town->getTownByDistrict($data['profile']->address_2);
		return view('profiles::edit', $data);
	}

	public function postEdit(Request $request, $id)
	{
		$input = $request->all();
		$input['id'] = $id;
		if (!$profile= Profile::find($id)) {
			return redirect()->route('list_customers');
		}

		$check = $profile->setData($input, $profile, 'action');
		if ($check['status'] != 0) {
			return redirect()->back()->withInput()->withErrors($check['validator']);
		}
		if ($profile->saveData()) {
			Session::flash('success', COMMON_SAVE_OK);
			$url = $request->session()->has('list_customers_url') ? $request->session()->get('list_customers_url') : route('list_customers');
			return redirect($url);
		}

		Session::flash('error', COMMON_SAVE_FAIL);
		return redirect()->route('edit_customers', ['id' => $id])->withInput();
	}

	public function export($request)
	{
		$profile = new Profile();
		$results = $profile->getList($request->all());

		$customer_list = array();
		$customer_list_temp = array();
		foreach ($results as $result)
		{
			$customer_list_temp[$result->id][] = array(
				'1' => $result->id,
				'2' => $result->email,
				'3' => $result->firstname,
				'4' => $result->lastname,
				'5' => $result->tel,
				'6' => $result->card_number,
				'7' => $result->postcode,
				'8' => $result->birth,
				'9' => $result->gender,
				'10' => $result->status,
				'11' => $result->city_name,
				'12' => $result->district_name,
				'13' => $result->address_3,
				'14' => $result->created_at,
			);
		}

		foreach($customer_list_temp as $customer_id => $rows)
		{
			foreach($rows as $k => $row)
			{
				$customer_list[] = $row;
			}
		}

		$customer_column = array('ID','Email','First Name','Last Name','Tel','Card Number','Postcode','Birth','Gender','Status','City','District','Home','Date');

		$customer[0] = $customer_column;

		foreach($customer_list as $customer_row)
		{
			$customer[] = $customer_row;
		}

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=customer_'.date('Ymd').'.csv');
		$fp = fopen('php://output', 'w');
		fputs($fp, $bom = (chr(0xEF).chr(0xBB).chr(0xBF)));
		foreach($customer as $k => $v)
		{
			fputcsv($fp, $v);
		}

		fclose($fp);
		exit();
	}
}