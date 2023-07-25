<?php

namespace App\Http\Middleware;

use App\Helpers\MyHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check() && !Auth::user()->is_active && !Auth::user()->hasRole('developer')) {
            $request->session()->flush();
            $request->session()->regenerate();
            Auth::logout();
            return redirect()->route('login')->with(['error' => __('Your account is not active!')]);
        }
        return $response;
    }
}
