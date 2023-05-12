<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;
use Illuminate\Http\Request;
class VoyagerAuthController extends BaseVoyagerAuthController
{
    public function postLogin(Request $request)
    {
        $this->validateLogin($request);
    if(getenv('APP_ENV') == 'production'){
            $request->validate(
                [
                'g-recaptcha-response' => 'required|captcha'
                ],
                [
                    'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                    'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
                ]
            );
        }
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}

