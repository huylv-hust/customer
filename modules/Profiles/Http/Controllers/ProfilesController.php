<?php namespace Modules\Profiles\Http\Controllers;

use App\City;
use App\District;
use App\Profile;
use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Pingpong\Modules\Routing\Controller;

class ProfilesController extends Controller
{
    public function index($token)
    {
        $city = new City();
        $data['cities'] = $city->getAllCity();
        $data['token'] = $token;
        return view('profiles::index', $data);
    }

    public function postProfile(Request $request)
    {
        if ($request->has('submit')) {
            $profile = new Profile();
            $input = $request->all();

            $input['email_id'] = $request['email_id'];
            $check = $profile->setData($input, $profile);
            if ($check['status'] != 0) {
                return redirect()->back()->withInput()->withErrors($check['validator']);
            }

            if ($profile->saveData()) {
                Session::flash('success', 'success');
                $email = $request['email'];
                Mail::send('emails.thanks', ['data' => $profile], function ($message) use ($email) {
                    $message->to($email, 'hi')
                        ->subject('Thanks for Registering');
                });
                return redirect()->route('thanks');
            }

            Session::flash('error', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function getThanks()
    {
        return view('profiles::thank');
    }

    public function getDistricts(District $district, Request $request)
    {
        $city_id = $request->input('city_id');
        $district = $district->getDistricts($city_id);
        return response()->json($district);
    }

    public function getTowns(Town $town, Request $request)
    {
        $district_id = $request->input('district_id');
        $district = $town->getTownByDistrict($district_id);
        return response()->json($district);
    }
}