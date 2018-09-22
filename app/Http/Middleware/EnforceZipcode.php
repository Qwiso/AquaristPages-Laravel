<?php

namespace App\Http\Middleware;

use Closure;

class EnforceZipcode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check())
            return redirect('/');

        if (auth()->user()->zipcode != null)
            return $next($request);

        return redirect('/');
    }
}
