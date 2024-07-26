<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int  $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->user_type == $type) {
                return $next($request);
            }
        }
        return redirect('/access_denied');
    }
}
