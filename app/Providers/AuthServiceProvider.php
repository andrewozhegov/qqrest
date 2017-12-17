<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\User;

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

        Gate::define('moder', function(User $user) {
            if ($user->role->id > 1) {
                return TRUE;
            }
            return FALSE;
        });

        Gate::define('staff', function(User $user) {
            if ($user->role->id > 2) {
                return TRUE;
            }
            return FALSE;
        });

        Gate::define('admin', function(User $user) {
            if ($user->role->id == 4) {
                return TRUE;
            }
            return FALSE;
        });

    }
}
