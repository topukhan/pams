<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        
        Gate::define('create-group', function ($user){
            return session('authorizedToCreateGroup', false);
        });

        Gate::define('access-request', function ($user) {
            return session('authorizedToAccessRequest', false);
        });

        Gate::define('access-my-group', function ($user) {
            return session('authorizedToAccessRequest', false);
        });
    }
}
