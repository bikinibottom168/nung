<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Ajax
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
        if($request->user_token)
        {
            $user = User::where('remember_token', $request->user_token)->first();

            if(!$user)
            {
                return abort(403);
            }
            else
            {
                if($user->admin == "1")
                {
                    return $next($request);
                }
                else
                {
                    return abort(403);
                }
            }
        }
    }
}
