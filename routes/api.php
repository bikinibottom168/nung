<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\movie;
use GuzzleHttp\Client;
use App\Collection;
use App\Request as req;
use App\Setting;
use App\User as user;
use App\Tv as tv;
use App\Pincode as pin;
use Carbon\Carbon;

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

