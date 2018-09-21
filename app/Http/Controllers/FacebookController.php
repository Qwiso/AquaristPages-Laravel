<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $authUser = Socialite::driver('facebook')->user();

        if (!$user = User::where('facebook_email', $authUser->getEmail())->first())
        {
            $user = new User();
            $user->name = $authUser->getName();
            $user->facebook_id = $authUser->getId();
            $user->facebook_email = $authUser->getEmail();
            $user->facebook_access_token = $authUser->token;
            $user->facebook_refresh_token = $authUser->refreshToken or null;
            $user->facebook_token_expires = $authUser->expiresIn;
            $uuid = md5($user->toJson());
            $user->uuid = $uuid;
            $user->save();
        }

        auth()->login($user, true);

        return redirect('/');
    }
}
