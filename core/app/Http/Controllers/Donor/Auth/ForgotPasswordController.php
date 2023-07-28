<?php

namespace App\Http\Controllers\Donor\Auth;

use App\Models\Donor;
use App\Models\DonorPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /*
        |--------------------------------------------------------------------------
        | Password Reset Controller
        |--------------------------------------------------------------------------
        |
        | This controller is responsible for handling password reset emails and
        | includes a trait which assists in sending these notifications from
        | your application to your users. Feel free to explore this trait.
        |
        */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('donor.guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm(): View
    {
        $pageTitle = 'Account Recovery';
        return view('student.auth.passwords.email', compact('pageTitle'));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('donors');
    }

    public function sendResetCodeEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = Donor::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['Email Not Available']);
        }

        $code = verificationCode(6);
        $donorPasswordReset = new DonorPasswordReset();
        $donorPasswordReset->email = $user->email;
        $donorPasswordReset->token = $code;
        $donorPasswordReset->status = 0;
        $donorPasswordReset->created_at = date("Y-m-d h:i:s");
        $donorPasswordReset->save();

        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();
        sendEmail($user, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => $userBrowser['os_platform'],
            'browser' => $userBrowser['browser'],
            'ip' => $userIpInfo['ip'],
            'time' => $userIpInfo['time'],
            'name' => $user->firstname,
            'username' => $user->username,
            'email' => $user->email,
        ]);
        $pageTitle = 'Account Recovery';
        $notify[] = ['success', 'Password reset email sent successfully'];
        return view('student.auth.passwords.code_verify', compact('pageTitle', 'notify'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required']);
        $notify[] = ['success', 'You can change your password.'];
        $code = str_replace(' ', '', $request->code);
        return redirect()->route('student.password.reset.form', $code)->withNotify($notify);
    }
}
