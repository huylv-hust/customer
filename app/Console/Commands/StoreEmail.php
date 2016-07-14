<?php

namespace App\Console\Commands;

use App\Email;
use App\Helpers\Constant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Mail_mimeDecode;

class StoreEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saveEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get email and store in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $source = file_get_contents("php://stdin");
        if(!$source) {
            exit;
        }

        $params['include_bodies'] = TRUE;
        $params['decode_bodies']  = TRUE;
        $params['decode_headers'] = TRUE;
        $decoder = new Mail_mimeDecode($source);
        $structure = $decoder->decode($params);
        $from = $structure->headers['from'];
        $from = mb_decode_mimeheader($from);
        $from = mb_convert_encoding($from, mb_internal_encoding(), 'auto');
        if (preg_match('/<(.*)>$/', $from, $matches)) {
            $from = $matches[1];
        }
        if(!$from) {
            exit;
        }
        //$from = 'thuanth23@gmail.com';
        $obj = new Email();
        $input['email'] = $from;
        $check = $obj->setData($input, $obj);
        if ($check['status'] != 0) {
            return false;
        }
        if ($obj->saveData()) {
            $id = $obj->id;
            $expired = time() + config('app.token_time');
            $token = Constant::encryptData(json_encode(['id' => $id, 'email' => $from, 'expired' => $expired]));
            Mail::send('emails.update_profile', ['token' => $token, 'time_expired' => $expired], function($message) use ($from) {
                $message->to($from, 'hi')
                    ->subject('Create Profile');
            });
        }
    }
}
