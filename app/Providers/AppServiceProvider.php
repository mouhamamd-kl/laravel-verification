<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        // RedirectIfAuthenticated::redirectUsing(function () {
        //     $currentGuard = Auth::guard();
        //     switch (Auth::guard($currentGuard)->check()&&$currentGuard=='merchant') {
        //         case 'merchant':
        //             return redirect()->route('merchant.index');
        //         default:
        //             return redirect()->route('merchant.index');
        //     }
        // });
    }
}
