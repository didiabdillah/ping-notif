<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{


    public function send_email()
    {
        Mail::to('ardiantry@gmail.com')->send(new MailtrapExample()); 
        return 'A message has been sent to Mailtrap!';
    }
}
