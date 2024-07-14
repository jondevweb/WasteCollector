<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/api/*'
    ];
}

// protected function configureRateLimiting()
// {
//     RateLimiter::for('meapi', function (Request $request) {
//         $session = $request->session()->get('client', null);
//         if ($session === null) return  Limit::perMinute(10)->by($request->ip());
//         return Limit::perMinute(100)->by($session['user']['id']);
//         //return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
//     });
//     RateLimiter::for('meapicollecteur', function (Request $request) {
//         $session = $request->session()->get('client', null);
//         if ($session === null) return  Limit::perMinute(20)->by($request->ip());
//         return Limit::perMinute(100)->by($session['user']['id']);
//         //return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
//     });
//     RateLimiter::for('meweb', function (Request $request) {
//         $session = $request->session()->get('client', null);
//         if ($session === null) return  Limit::perMinute(10)->by($request->ip());
//         return Limit::perMinute(100)->by($session['user']['id']);
//         //return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
//     });
//     RateLimiter::for('mestrong', function (Request $request) {
//         return Limit::perMinute(10);
//     });

// }