<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Profile;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPanelPolicies();
        $this->registerProfilePolicies();
        //
    }

    public function registerPanelPolicies() {

        Gate::define('banned', function($user) {
            return $user->hasAccess(['banned']);
        });
        Gate::define('propose_news', function($user) {
            return $user->hasAccess(['propose_news']);
        });
        Gate::define('can_candidature', function($user) {
            return $user->hasAccess(['can_candidature']);
        });
        Gate::define('can_mute', function($user) {
            return $user->hasAccess(['can_mute']);
        });
        Gate::define('can_ban', function($user) {
            return $user->hasAccess(['can_ban']);
        });
        Gate::define('can_manage_news', function($user) {
            return $user->hasAccess(['can_manage_news']);
        });
        Gate::define('can_promote', function($user) {
            return $user->hasAccess(['can_promote']);
        });
        Gate::define('can_demote', function($user) {
            return $user->hasAccess(['can_demote']);
        });
        Gate::define('universal_protection', function($user) {
            return $user->hasAccess(['universal_protection']);
        });
        Gate::define('staff', function($user) {
            return $user->hasAccess(['staff']);
        });
    }

    public function registerProfilePolicies()
    {
        Gate::define('modify-profile', function($user, Profile $profile) {
            return $user->hasAccess(['modify-profile']) or $user->id == $profile->user_id;
        });
        Gate::define('delete-profile', function($user, Profile $profile) {
            return $user->hasAccess(['delete-profile']) or $user->id == $profile->user_id;
        });
    }
}
