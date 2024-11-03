<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as MiddlewareRedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated extends MiddlewareRedirectIfAuthenticated
{
    /**
     * The callback that should be used to generate the authentication redirect path.
     *
     * @var callable|null
     */
    protected static $redirectToCallback;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if(Auth::guard($guard)->check()&&$guard=='merchant'){
                return to_route('merchant.index');
            }
            if (Auth::guard($guard)->check()) {
                return redirect($this->redirectTo($request));
            }
        }

        return $next($request);
    }
}
