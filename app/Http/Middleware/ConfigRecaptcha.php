<?php

namespace App\Http\Middleware;

use Closure;
use App\Option;

class ConfigRecaptcha
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
        $sitekey = option_get('recaptcha.sitekey');
        $secret = option_get('recaptcha.secret');
        
        config(['captcha.sitekey' => $sitekey,'captcha.secret' => $secret]);
        
        return $next($request);
    }
}
