<?php

namespace App\Http\Controllers\Auth;

use App;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins;
    use AuthenticatesAndRegistersUsers {
        register as ARURegister;
        sendFailedLoginResponse as sendFailedLoginResponseNotAjax;
        handleUserWasAuthenticated as handleUserWasAuthenticatedNotAjax;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/account/profile';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            // 'terms' => 'required' // Moved to form's last step
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            // 'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'language' => App::getLocale(),
        ]);
    }
    
    public function register(Request $request) {
        if ($request->ajax()) {
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }

            Auth::guard($this->getGuard())->login($this->create($request->all()));
            return array('redirect' => 'account/question/1');
        } else {
            return $this->ARURegister($request);
        }
    }
    
    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->ajax()) {
            return Response::json(array(
                $this->loginUsername() => $this->getFailedLoginMessage()
            ), 422);
        }
        
        return $this->sendFailedLoginResponseNotAjax($request);
    }
    
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($request->ajax()) {
            if ($throttles) {
                $this->clearLoginAttempts($request);
            }

            return array('redirect' => $this->redirectPath());
        }
        
        return $this->handleUserWasAuthenticatedNotAjax($request);
    }
}
