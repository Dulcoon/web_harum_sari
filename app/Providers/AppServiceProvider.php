<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Definisikan rate limiter API
        RateLimiter::for('api', function (Request $request) { // Pastikan $request adalah Illuminate\Http\Request
            return $request->user()
                ? Limit::perMinute(60)->by($request->user()->id) // Limit berdasarkan user ID
                : Limit::perMinute(60)->by($request->ip()); // Limit berdasarkan IP
        });
    }
}
