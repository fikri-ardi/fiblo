<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('role', function (User $user, $role) {
            return $user->hasRole($role);
        });

        Gate::define('username', function (User $user, $username) {
            return $user->username === $username;
        });

        Gate::define('update-user', function (User $authenticatedUser, User $user) {
            return $authenticatedUser->username === $user->username;
        });
    }
}
