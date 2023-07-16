<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Models\Agent;
use App\Models\AgentPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

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
        $this->middleware('agent.guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $pageTitle = 'Account Recovery';
        return view('agent.auth.passwords.email', compact('pageTitle'));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('agents');
    }

    public function sendResetCodeEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = Agent::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['Email Not Available']);
        }

        $code = verificationCode(6);
        $agentPasswordReset = new AgentPasswordReset();
        $agentPasswordReset->email = $user->email;
        $agentPasswordReset->token = $code;
        $agentPasswordReset->status = 0;
        $agentPasswordReset->created_at = date("Y-m-d h:i:s");
        $agentPasswordReset->save();

        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();
        try {
            sendEmail($user, 'PASS_RESET_CODE', [
                'code' => $code,
                'operating_system' => $userBrowser['os_platform'],
                'browser' => $userBrowser['browser'],
                'ip' => $userIpInfo['ip'],
                'time' => $userIpInfo['time'],
                'name' => $user->username,
                'email' => $user->email,
            ]);
            Log::info('Password reset code sent to - ' . $user->email);
        } catch (\Exception $exp) {
            Log::error($exp->getMessage());
            $notify[] = ['error', 'Something went wrong'];
            return back()->withNotify($notify);
        }
        $pageTitle = 'Account Recovery';
        $notify[] = ['success', 'Password reset email sent successfully'];
        return view('agent.auth.passwords.code_verify', compact('pageTitle', 'notify'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required']);
        $notify[] = ['success', 'You can change your password.'];
        $code = str_replace(' ', '', $request->code);
        return redirect()->route('agent.password.reset.form', $code)->withNotify($notify);
    }
}
