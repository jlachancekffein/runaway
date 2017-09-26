<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Redirect;
use Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('googleLogin');
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
        if ($authUser = User::where('google_id', $user->id)->first()) {
            return $authUser;
        }

        if ($authUser = User::where('email', $user->email)->first()) {
            $authUser->google_id = $user->id;
            $authUser->avatar = $user->avatar;
            $authUser->save();
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'google_id' => $user->id,
            'avatar' => $user->avatar
        ]);
    }
}
