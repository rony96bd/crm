<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use App\Mail\SignupEmailAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupEmail($firstname, $email)
    {
        $data = [
            'firstname' => $firstname,
            // 'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }

    public static function sendSignupEmailAgent($name, $email)
    {
        $data = [
            'name' => $name,
            // 'verification_code' => $verification_code
        ];
        Mail::to($email)->send(new SignupEmailAgent($data));
    }
}
