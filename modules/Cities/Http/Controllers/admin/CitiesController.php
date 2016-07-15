<?php

namespace Modules\Cities\Http\Controllers\Admin;

use App\City;
use App\Http\Requests\CityPostRequest;
use Illuminate\Support\Facades\Session;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * list city
     * @param Request $request
     * @param City $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, City $city)
    {
        $data['filter'] = $request->all();
        $data['cities'] = $city->getList($data['filter']);
        $query_string = empty($data['filters']) ? '' : '?' . http_build_query($data['filters']);
        $request->session()->put('list_city_url', $request->url() . $query_string);
        return view('cities::admin/index', $data);
    }

    /**
     * create city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        $data['title'] = 'Create City';
        $data['url'] = route('create_city');
        return view('cities::admin/action_city', $data);
    }

    /**
     * process create city
     * @param Request $request
     * @param City $city
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCreate(CityPostRequest $request, City $city)
    {
        $input = $request->all();
        $city->setData($input, $city);
        if ($city->saveData()) {
            Session::flash('success', COMMON_SAVE_OK);
            $url = $request->session()->has('list_city_url') ? $request->session()->get('list_city_url') : route('list_city');
            return redirect($url);
        }

        Session::flash('error', COMMON_SAVE_FAIL);
        return redirect()->route('create_city')->withInput();
    }

    /**
     * edit city
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $data['obj'] = City::find($id);
        if (!isset($data['obj'])) {
            return redirect()->route('list_city');
        }
        $data['title'] = 'Edit City';
        $data['url'] = route('edit_city', ['id' => $id]);
        return view('cities::admin/action_city', $data);
    }

    /**
     * process edit city
     * @param CityPostRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(CityPostRequest $request, $id)
    {
        $input = $request->all();
        $input['id'] = $id;
        if (!$city = City::find($id)) {
            return redirect()->route('list_city');
        }

        $city->setData($input, $city);
        if ($city->saveData()) {
            Session::flash('success', COMMON_SAVE_OK);
            $url = $request->session()->has('list_city_url') ? $request->session()->get('list_city_url') : route('list_city');
            return redirect($url);
        }

        Session::flash('error', COMMON_SAVE_FAIL);
        return redirect()->route('edit_city', ['id' => $id])->withInput();
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

        if (City::destroy($id)) {
            Session::flash('success', COMMON_SAVE_OK);
        } else {
            Session::flash('error', COMMON_SAVE_FAIL);
        }
        return redirect()->back();
    }
}