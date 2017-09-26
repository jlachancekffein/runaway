<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords {
        sendResetLinkEmail as sendResetLinkEmailNotAjax;
        reset as resetNotAjax;
    }

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        if ($request->ajax()) {
            $this->validateSendResetLinkEmail($request);

            $broker = $this->getBroker();

            $response = Password::broker($broker)->sendResetLink(
                $this->getSendResetLinkEmailCredentials($request),
                $this->resetEmailBuilder()
            );

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return array();
                case Password::INVALID_USER:
                default:
                    return Response::json(['email' => trans('passwords.userNotFound')], 422);
                    // return $this->getSendResetLinkEmailFailureResponse($response);
            }
        }
        
        return $this->sendResetLinkEmailNotAjax($response);
    }
    
    public function reset(Request $request)
    {
        if ($request->ajax()) {
            $this->validate(
                $request,
                $this->getResetValidationRules(),
                $this->getResetValidationMessages(),
                $this->getResetValidationCustomAttributes()
            );

            $credentials = $this->getResetCredentials($request);

            $broker = $this->getBroker();

            $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
                $this->resetPassword($user, $password);
            });

            switch ($response) {
                case Password::PASSWORD_RESET:
                    return array('redirect' => route('profile', ['message' => trans('passwords.passwordChanged')]));
                default:
                    return $this->getResetFailureResponse($request, $response);
            }
        }
        
        return $this->resetNotAjax($request);
    }
}
