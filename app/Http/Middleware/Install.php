<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Schema;

class Install
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
        if (!Schema::hasTable('settings')) {
            return redirect()->route('install');
        }

        return $next($request);
    }
}
