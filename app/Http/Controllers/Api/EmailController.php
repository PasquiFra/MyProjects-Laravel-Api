<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class EmailController extends Controller
{
    public function sendTestEmail(Request $request)
    {
        $data = $request->all();

        // $new_lead = new ContactMail();
        // $new_lead = fill($data);
        // $new_lead = save();

        // $to_email = 'admin@boofolio.com';

        // Mail::to($to_email)->send(new ContactMail($new_lead));

        // return "E-mail inviata a $to_email";
    }
}
