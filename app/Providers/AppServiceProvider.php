<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        $this->ensureProductionAssets();

        // Definisikan rate limiter API
        RateLimiter::for('api', function (Request $request) { // Pastikan $request adalah Illuminate\Http\Request
            return $request->user()
                ? Limit::perMinute(60)->by($request->user()->id) // Limit berdasarkan user ID
                : Limit::perMinute(60)->by($request->ip()); // Limit berdasarkan IP
        });
    }

    /**
     * Guard against a leftover Vite dev-server marker ("hot" file). When that
     * file exists, Laravel's @vite directive serves assets from
     * http://127.0.0.1:5173 instead of the compiled build/ folder, which breaks
     * all styling on production.
     *
     * The check is intentionally environment-independent so it still works when
     * APP_ENV is misconfigured on the server. The hot file is only kept when it
     * actually points at a local dev server on a locally-hosted app.
     */
    protected function ensureProductionAssets(): void
    {
        $hotFile = public_path('hot');

        if (! is_file($hotFile) && ! is_link($hotFile)) {
            return;
        }

        $hotHost = parse_url((string) @file_get_contents($hotFile), PHP_URL_HOST) ?: '';
        $appHost = parse_url((string) config('app.url'), PHP_URL_HOST) ?: '';

        $isLoopback = fn (string $host): bool => in_array($host, ['127.0.0.1', 'localhost', '::1'], true);

        // Real development machine: dev server on a loopback host and the app
        // itself is also served from a loopback host. Keep hot reload working.
        if ($isLoopback($hotHost) && $isLoopback($appHost)) {
            return;
        }

        // Production / non-local: never serve assets from a dev server.
        if (! $this->app->environment('local')) {
            @unlink($hotFile);

            return;
        }

        // Local env but the app is served from a real domain while the hot file
        // still points at a dev server: treat it as stale and remove it.
        if ($isLoopback($hotHost) && ! $isLoopback($appHost)) {
            @unlink($hotFile);
        }
    }
}
