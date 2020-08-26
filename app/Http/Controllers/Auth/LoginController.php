<?php

namespace App\Http\Controllers\Auth;

use App\DiscordAccount;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Discord authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToDiscord()
    {
        return Socialite::driver('discord')->redirect();
    }

    /**
     * Obtain the user information from Discord.
     *
     * @return \Illuminate\Http\Response
     */
    public function callbackDiscord()
    {
        try {
            $user_info = Socialite::driver('discord')->user();
        } catch (\Exception $e) {
            return redirect('login')->with('error', $e->getMessage());
        }
        if (Auth::check()) {
            $account = new DiscordAccount([
                'discord_user_id' => $user_info->getId(),
            ]);
            $account->user()->associate(Auth::user());
            return redirect($this->redirectTo)->with('success', 'Discord account linked to your account');
        }
        $account = DiscordAccount::whereDiscordUserId($user_info->getId())->first();
        if (! $account) {
            $account = new DiscordAccount([
                'discord_user_id' => $user_info->getId(),
            ]);
        } else {
            Auth::login($account->user, true);

            return redirect($this->redirectTo);
        }
        $user = User::whereEmail($user_info->getEmail())->first();
        if (! $user) {
            $user = User::create([
                'email' => $user_info->getEmail(),
                'name' => $user_info->getName(),
            ]);
            $user->assignRole('joueur');
        }
        $account->user()->associate($user);
        $account->save();
        Auth::login($account->user, true);

        return redirect($this->redirectTo)->with('success', 'Logged in successfully');
    }
}
