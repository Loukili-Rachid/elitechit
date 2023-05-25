<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientVerify;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Client::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => 'required|min:8',
        ]);

        $clientStatus = Status::where('model', class_basename(Client::class))
        ->where('name', 'active')
        ->first();

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_id' => $clientStatus->id,
        ]);
        
        Auth::guard('client')->login($client);

        $token = Str::random(64);
        ClientVerify::create([
            'client_id' => $client->id, 
            'token' => $token
        ]);
        try {
            Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
                $message->from($request->email, $request->name);
                $message->sender('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->to($request->email);
                $message->replyTo('contact@elitechit.com', env('MAIL_FROM_NAME'));
                $message->subject('Email Verification Mail');
                $message->priority(1);
                //$message->attach('pathToFile');
            });
        } catch (\Swift_TransportException $e) {
            if ($e->getMessage()) {
                return back()->with('error', 'Something went wrong. Please try again later.');
            }
        }

        return redirect()->route('verification.notice');
    }

    public function verifyClient($token){
        $verifyClient = ClientVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyClient) ){
            $client = $verifyClient->client;
              
            if(!$client->is_email_verified) {
                $verifyClient->client->email_verified_at = Carbon::now();
                $verifyClient->client->is_email_verified = 1;
                $verifyClient->client->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
      return redirect()->route('showLoginForm')->with('success', $message);
    }
}
