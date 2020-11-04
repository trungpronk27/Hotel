<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        // Gate::define('dashboard', function ($user) {
        //     return $user->hasAccess(['dashboard']);
        // });
        Gate::define('act-user', function($user){
            return $user->hasAccess(['act-user']);
        });
        Gate::define('act-administration', function($user){
            return $user->hasAccess(['act-administration']);
        });
        Gate::define('act-accountant', function($user){
            return $user->hasAccess(['act-accountant']);
        });
        Gate::define('act-receptionist', function($user){
            return $user->hasAccess(['act-receptionist']);
        });
    }
}
