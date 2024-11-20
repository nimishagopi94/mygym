<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('schedule-class',function(User $user){
            return $user->role === 'instructor';
        });
        Gate::define('book-class',function(User $user){
            return $user->role === 'member';
        });
    }
}
