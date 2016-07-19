<?php

namespace Modules\Towns\Http\Controllers\Admin;

use App\City;
use App\District;
use App\Town;
use App\Http\Requests\TownPostRequest;
use Illuminate\Support\Facades\Session;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;

class TownsController extends Controller
{
    /**
     * list town
     * @param Request $request
     * @param Town $town
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(City $city, District $district, Request $request, Town $town)
    {
        $data['filter'] = $request->all();
        $data['towns'] = $town->getList($data['filter']);
        if (isset($data['filter']['district_id']) && $data['filter']['district_id']) {
            $data['districts'] = $district->getDistricts($data['filter']['city_id']);
        }
        $data['cities'] = $city->getAllCity();
        $query_string = empty($data['filters']) ? '' : '?' . http_build_query($data['filters']);
        $request->session()->put('list_town_url', $request->url() . $query_string);
        return view('towns::admin/index', $data);
    }

    /**
     * create town
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate(City $city)
    {
        $data['title'] = 'Create Town';
        $data['url'] = route('create_town');
        $data['cities'] = $city->getAllCity();
        $data['districts'] = [];
        return view('towns::admin/action_town', $data);
    }

    /**
     * process create town
     * @param Request $request
     * @param Town $town
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCreate(TownPostRequest $request, Town $town)
    {
        $input = $request->all();
        $town->setData($input, $town);
        if ($town->saveData()) {
            Session::flash('success', COMMON_SAVE_OK);
            $url = $request->session()->has('list_town_url') ? $request->session()->get('list_town_url') : route('list_town');
            return redirect($url);
        }

        Session::flash('error', COMMON_SAVE_FAIL);
        return redirect()->route('create_town')->withInput();
    }

    /**
     * edit town
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit(City $city, District $district, $id)
    {
        $data['obj'] = Town::find($id);
        if (!isset($data['obj'])) {
            return redirect()->route('list_town');
        }
        $data['title'] = 'Edit Town';
        $data['cities'] = $city->getAllCity();
        $data['districts'] = $district->getDistricts($data['obj']->city_id);
        $data['url'] = route('edit_town', ['id' => $id]);
        return view('towns::admin/action_town', $data);
    }

    /**
     * process edit town
     * @param TownPostRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(TownPostRequest $request, $id)
    {
        $input = $request->all();
        $input['id'] = $id;
        if (!$town = Town::find($id)) {
            return redirect()->route('list_town');
        }

        $town->setData($input, $town);
        if ($town->saveData()) {
            Session::flash('success', COMMON_SAVE_OK);
            $url = $request->session()->has('list_town_url') ? $request->session()->get('list_town_url') : route('list_town');
            return redirect($url);
        }

        Session::flash('error', COMMON_SAVE_FAIL);
        return redirect()->route('edit_town', ['id' => $id])->withInput();
    }

    /**
     * delete town
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

        if (Town::destroy($id)) {
            Session::flash('success', COMMON_SAVE_OK);
        } else {
            Session::flash('error', COMMON_SAVE_FAIL);
        }
        return redirect()->back();
    }
}