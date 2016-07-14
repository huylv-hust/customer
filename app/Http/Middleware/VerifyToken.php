<?php

namespace App\Http\Middleware;

use App\Helpers\Constant;
use Closure;
/**
 * Author thuanth6589
 * Class VerifyToken
 * @package App\Http\Middleware
 */
class VerifyToken
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = Constant::decryptData($request->token);
        $decode = json_decode($token);
        if (isset($decode->id) && $decode->id && isset($decode->email) && $decode->email && isset($decode->expired) && $decode->expired > time()) {
            $request['email_id'] = $decode->id;
            $request['email'] = $decode->email;
            return $next($request);
        }
        abort(406);
    }
}
