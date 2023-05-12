<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\MaintenanceToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MaintenanceController extends Controller
{
    public function setMode(Request $request, $token)
    {
        function openSession($token, $value)
        {
            $tokenUpdate = MaintenanceToken::where('token', $token)->first();
            if ($tokenUpdate->start_at == null) {
                $tokenUpdate->start_at = \Carbon\Carbon::now();
            }
            $tokenUpdate->ip_address = AppHelper::getClientIp();
            $tokenUpdate->save();
            Session::put('preview_token', $value->token);
            Session::put('preview_expired_at', \Carbon\Carbon::now()->addMinute($value->expired_at));
        }

        if (
            App()->maintenance['maintenance']->active
            && App()->maintenance['maintenance']->preview
        ) {
            $request->merge(['token' => $token]);
            $validator = Validator::make($request->all(), [
                'token' => 'required|alpha|size:50'
            ]);

            if ($validator->fails()) {
                abort(redirect('maintenance'));
            }
            if (Session::has('preview_expired_at') && session('preview_token')) {
                //session is opened
                return redirect('/');
                die();
            }
            foreach (App()->maintenance['maintenance']->tokens as $key => $value) {

                if ($token == $value->token && $value->active == 1 && !Session::has('preview_expired_at')) {
                    if (!$value->multi_device && $value->start_at == null) {
                        // multi_device == 0
                        //  start_at == 0
                        openSession($token, $value);
                        return redirect('/');
                        die();
                    }

                    if ($value->multi_device && $value->start_at == null) {
                        // multi_device == 1
                        //  start_at == 0
                        openSession($token, $value);
                        return redirect('/');
                        die();
                    }

                    if (
                        $value->multi_device  &&
                        $value->start_at != null &&
                        \Carbon\Carbon::parse($value->start_at)->addMinute($value->expired_at)->timestamp >=
                        \Carbon\Carbon::now()->timestamp
                    ) {
                        // multi_device == 1
                        // start_at == 1
                        // start_at > now + expired at
                        openSession($token, $value);
                        return redirect('/');
                        die();
                    }
                }
            }

            abort(redirect('maintenance'));
        } else {
            abort(401);
        }
    }
}
