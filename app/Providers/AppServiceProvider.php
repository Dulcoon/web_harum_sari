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
     * A hot file is only kept for a genuine local setup: APP_ENV=local, the dev
     * server on loopback, and the app itself reached through a loopback host.
     * Every other combination is treated as stale and removed.
     */
    protected function ensureProductionAssets(): void
    {
        $hotFile = public_path('hot');

        if (! is_file($hotFile) && ! is_link($hotFile)) {
            return;
        }

        $hotHost = parse_url((string) @file_get_contents($hotFile), PHP_URL_HOST) ?: '';

        // Prefer the real request host; fall back to APP_URL for console usage.
        $requestHost = $this->app->runningInConsole()
            ? (parse_url((string) config('app.url'), PHP_URL_HOST) ?: '')
            : request()->getHost();

        $isLoopback = fn (string $host): bool => in_array($host, ['127.0.0.1', 'localhost', '::1'], true);

        $isGenuineLocalDev = $this->app->environment('local')
            && $isLoopback($hotHost)
            && $isLoopback($requestHost);

        if ($isGenuineLocalDev) {
            return;
        }

        @unlink($hotFile);
    }
}
