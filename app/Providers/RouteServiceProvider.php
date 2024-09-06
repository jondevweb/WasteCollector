<?php 

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function ($request) {
            return Limit::perMinute(60)->by($request->email ?: $request->ip());
        });
    }
}

        // Autres définitions de rate limiting

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