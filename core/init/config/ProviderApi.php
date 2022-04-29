<?php

use Illuminate\Http\Request;
use App\Setting;
use App\movie;
use App\Tv;
/**
 *  Cron Join Update Movie
 * 
 */
Route::get('v1/seo/{key}', 'ApiController@seo');
Route::get('v1/category/{key}', 'ApiController@category');
Route::get('v1/update/{token_hash}', 'ApiController@api');
Route::get('v1/update/{token_hash}', 'ApiController@api');
Route::get('v1/update-category/{token_hash}', 'ApiController@api_category');
Route::get('v1/movie/{token}', 'ApiController@movie_api');
Route::get('v1/movie-category/{token}', 'ApiController@movie_category_api');

// Ajax Update
Route::post('v1/ajax', 'AjaxController@index');

Route::get('v1/update/playlist/{id_playlist}/{id_movie}/{token_hash}', 'ApiController@update_playlist');



