<?php

use App\Collection;
use App\movie;
use App\Pincode as pin;
use App\Request as req;
use App\Setting;
use App\Tv as tv;
use App\User as user;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('v1/movieall/{token}', 'ApiController@movieall');

// Route::get('v1/description/{token}', 'ApiController@description');

// Route::get('v1/request/{title}', 'ApiController@request');

// Route::get('v1/moviecontact/{movieid}/', 'ApiController@moviecontact');

// Route::get('v1/collector/{id}/{movie}/{type}', 'ApiController@collector');

Route::get('v1/loadmovie/{id?}/{ep?}/{player?}', 'ApiController@loadmovie');
