<?php

namespace Modules\Districts\Http\Controllers\Admin;

use App\District;
use App\City;
use App\Http\Requests\DistrictPostRequest;
use Illuminate\Support\Facades\Session;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    /**
	 *
	 * @param Request $request
	 * @param District $district
	 * @return type
	 */
    public function index(Request $request, District $district)
    {
        $data['filter'] = $request->all();
        $data['districts'] = $district->getDistrict($data['filter']);
        $query_string = empty($data['filters']) ? '' : '?' . http_build_query($data['filters']);
        $request->session()->put('list_district_url', $request->url() . $query_string);
        return view('districts::admin/index', $data);
    }

   /**
    *
    * @param City $city
    * @return type
    */
    public function getCreate(City $city)
    {
        $data['title'] = 'Create Districts';
		$data['city'] = $city->getAllCity();
        $data['url'] = route('create_district');
        return view('districts::admin/action_district', $data);
    }

   /**
    *
    * @param DistrictPostRequest $request
    * @param District $district
    * @return type
    */
    public function postCreate(DistrictPostRequest $request, District $district)
    {
        $input = $request->all();
        $district->setData($input, $district);
        if ($district->saveData()) {
            Session::flash('success', COMMON_SAVE_OK);
            $url = $request->session()->has('list_district_url') ? $request->session()->get('list_district_url') : route('list_district');
            return redirect($url);
        }

        Session::flash('error', COMMON_SAVE_FAIL);
        return redirect()->route('create_district')->withInput();
    }

    /**
     * edit city
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit($id,  City $city)
    {
        $data['obj'] = District::find($id);
		$data['city'] = $city->getAllCity();
        if (!isset($data['obj'])) {
            return redirect()->route('list_district');
        }
        $data['title'] = 'Edit District';
        $data['url'] = route('edit_district', ['id' => $id]);
        return view('districts::admin/action_district', $data);
    }

    /**
     * process edit city
     * @param CityPostRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(DistrictPostRequest $request, $id)
    {
        $input = $request->all();
        $input['id'] = $id;
        if (!$district = District::find($id)) {
            return redirect()->route('list_district');
        }

        $district->setData($input, $district);
        if ($district->saveData()) {
            Session::flash('success', COMMON_SAVE_OK);
            $url = $request->session()->has('list_district_url') ? $request->session()->get('list_district_url') : route('list_district');
            return redirect($url);
        }

        Session::flash('error', COMMON_SAVE_FAIL);
        return redirect()->route('edit_district', ['id' => $id])->withInput();
    }

    /**
     * delete city
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)) {
            Session::flash('error', AT_LEAST_1_RECORD);
            return redirect()->back();
        }

        if (District::destroy($id)) {
            Session::flash('success', COMMON_SAVE_OK);
        } else {
            Session::flash('error', COMMON_SAVE_FAIL);
        }
        return redirect()->back();
    }
}