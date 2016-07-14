<?php
namespace App\Http\Controllers;

use App\Email;
use App\Helpers\Constant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class EmailsController extends Controller
{
    public function getEmail(Request $request, $email)
    {
        $obj = new Email();
        $input['email'] = $email;
        $check = $obj->setData($input, $obj);
        if ($check['status'] != 0) {
            return false;
        }
        if ($obj->saveData()) {
            $id = $obj->id;
            $expired = time() + config('app.token_time');
            $token = Constant::encryptData(json_encode(['id' => $id, 'email' => $email, 'expired' => $expired]));
            Mail::send('emails.update_profile', ['token' => $token, 'time_expired' => $expired], function($message) use ($email) {
                $message->to($email, 'test')
                    ->subject('Create Profile');
            });
        }
    }
}