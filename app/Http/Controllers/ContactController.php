<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactEmail;
use App\Models\Contact;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    public function contact(StoreContactRequest $request)
    {
        $validated = $request->validated();
        $mailData = [
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message
        ];
        $contact = Contact::create($validated);
 
        if ($contact) {
            try {
                Mail::send('email.contact', ['mailData' => $mailData], function ($message) use ($request) {
                    $message->from($request->email, $request->full_name);
                    $message->sender('contact@elitechit.com', env('MAIL_FROM_NAME'));
                    $message->to('contact@elitechit.com');
                    $message->replyTo($request->email, $request->name);
                    $message->subject($request->subject);
                    $message->priority(1);
                    //$message->attach('pathToFile');
                });
            } catch (\Swift_TransportException $e) {
                if ($e->getMessage()) {
                    return back()->with('error', 'Something went wrong. Please try again later.');
                }
            }
        } else {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
        return back()->with('success', "Your message is successfully sent.");
    }
}
