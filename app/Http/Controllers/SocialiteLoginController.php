<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Team;
use App\Providers\RouteServiceProvider;

class SocialiteLoginController extends Controller
{
	/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('discord')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $socialite_user = Socialite::driver('discord')->user();
        $user = User::where('email', $socialite_user->email)->first();

        if (is_null($user)) {
            $user = tap(User::create([
                'name' => $socialite_user->getName(),
                'email' => $socialite_user->getEmail(),
                'discord' => (int)$socialite_user->getId(),
                'discord_nickname' => $socialite_user->getNickname(),
            ]), function (User $user) {
                $user->assignRole('Joueur');
            });
        } else {
        	if ($user->discord == 0) {
                $user->discord = $socialite_user->getId();
        	}
        	if ($user->discord_nickname != $socialite_user->getNickname()) {
        		$user->discord_nickname = $socialite_user->getNickname();
        	}
            $user->save();
        }
        Auth::login($user, true);
        return redirect(RouteServiceProvider::HOME);
    }
}
