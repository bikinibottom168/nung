<?php

namespace App\Http\Middleware;

use App\movie;
use Route;
use Silber\PageCache\Middleware\CacheResponse as BaseCacheResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse extends BaseCacheResponse
{
    protected function shouldCache(Request $request, Response $response)
    {
        // In this example, we don't ever want to cache pages if the
        // URL contains a query string. So we first check for it,
        // then defer back up to the parent's default checks.
        if ($request->getQueryString()) {
            return false;
        }

        if (Route::is('home') || Route::is('year')) {
            // return false;
            return parent::shouldCache($request, $response);
        } elseif (Route::is('movie')) {
            // dd($request['requestUri']);
            // $find_id = movie::find()
            return false;
        }

        return false;
        // return parent::shouldCache($request, $response);
    }
}
