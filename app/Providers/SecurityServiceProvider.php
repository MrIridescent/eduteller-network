<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class SecurityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // 1. Strict Rate Limiting for Narrative APIs
        RateLimiter::for('api.educational', function (Request $request) {
            return Limit::perMinute(30)->by($request->user()?->id ?: $request->ip())->response(function (Request $request, array $headers) {
                return response('Too many narrative attempts. Take a breath and try again.', 429, $headers);
            });
        });

        // 2. Global API Rate Limiter
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // 3. Security Headers Implementation (CSP etc)
        // This would typically be in a Middleware, but defined here for strategy context
    }
}
