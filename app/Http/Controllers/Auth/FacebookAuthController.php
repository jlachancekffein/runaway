<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Redirect;
use Socialite;

class FacebookAuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect()->route('facebookLogin');
        }

        if( !$user->email ){
            $user->email = "$user->id@facebooklogin.com";
        }        

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect()->route('profile');
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $user
     * @return User
     */
    private function findOrCreateUser($user)
    {
        if ($authUser = User::where('facebook_id', $user->id)->first()) {
            return $authUser;
        }

        if ($authUser = User::where('email', $user->email)->first()) {
            $authUser->facebook_id = $user->id;
            $authUser->avatar = $user->avatar;
            $authUser->save();
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'facebook_id' => $user->id,
            'avatar' => $user->avatar
        ]);
    }
}
