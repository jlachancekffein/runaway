<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessage(SendMessageRequest $request)
    {
        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'text' => $request->input('message') // Can't be named message. laravel.com/docs/5.2/mail
        );
        
        Mail::send(['emails.contact', 'emails.contact-plain'], $data, function ($m) {
            $m->to(trans('general.r2dEmail'), 'Runway 2 Doorway')->subject(trans('contact.emailSubject'));
        });
    }
}
