<?php

// Auth::routes();

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 *  Sitemap default SEO
 *  #List XML
 *  - Index Show Category XML (post, category_movie, tag)
 */
// Route::get('/av/get', 'MovieController@avGet')->name('av.get');
// Route::post('/av/get', 'MovieController@avPost')->name('av.post');

// -----------------------------
//      Install ติดตั้ง
// -----------------------------
// Route::get('/install', 'InstallController@index')->name('install');
// Route::post('/install', 'InstallController@store')->name('install.submit');
// Route::get('/support', 'InstallController@index')->name('support');


Route::get('/robots.txt', 'SitemapController@robots_txt')->name('sitemap.txt');
Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap.index');
Route::get('/sitemap-post.xml', 'SitemapController@post')->name('sitemap.post');
Route::get('/sitemap-category.xml', 'SitemapController@category')->name('sitemap.category');
Route::get('/sitemap-tag-movie.xml', 'SitemapController@tag')->name('sitemap.tag');



##################################################


// -----------------------------
//      Movie Resource
// -----------------------------
//  Index หน้าแรก
Route::get('/', 'MovieController@index')->name('home');
//  แสดงหนังรูปแบบอื่นๆ
Route::get('tag/{title}', 'MovieController@movie_tag')->name('movie_tag');
//  Category แสดงหมวดหมู่
Route::get('category/{title}/', 'MovieController@category')->name('category');
//  Playlist รวมหนัง
Route::get('playlist/{title}/', 'MovieController@playlist')->name('playlist');
//  Movie แสดงหนัง
Route::get('/{title}/', 'MovieController@movie')->name('movie'); // แบบ Slug 

//  Year แสดงหนังตามปี
Route::get('/year/{year}', 'MovieController@year')->name('year'); // แบบ Slug 

//  Search ค้นหา
Route::get('/s/search', 'MovieController@search')->name('search');

//  About เกี่ยวกับ
Route::get('/about/{id}', 'MovieController@about')->name('about');

//  Streaming
Route::get('/streaming/{url}', 'MovieController@streaming')->name('streaming');

//  จำนวนคลิ๊กโฆษณา
Route::get('/ads/redirect/{id}', 'MovieController@ads_redirect')->name('ads_redirect');

//  Overlay
Route::get('/ads/overlay.xml', 'MovieController@overlay')->name('overlay');

//  Movie แสดงหนังทั้งหมด
Route::middleware('page-cache')->get('movies', 'MovieController@movies')->name('movies');
//  Letters A-Z
Route::get('letters/{letters?}', 'MovieController@letters')->where('letters', '[A-Z]+')->name('letters');
Route::get('letters/0-9', 'MovieController@letters_number')->name('letters_number');

//  Collection
Route::get('collection/{type?}', 'HomeController@collection')->name('collection');
Route::post('/collect/{id}/{type}', 'HomeController@collectDelete')->name('member.delete.collection');

//  News ข่าวสาร
Route::get('/article/{title}', 'MovieController@news')->name('article');
Route::get('/articles/all', 'MovieController@news_all')->name('article.all');



Route::middleware('recaptcha')->get('/admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::prefix('dashboard')->group(function () {
        Route::get('/', 'AdminController@index')->name('admin.home');
        Route::get('help', 'AdminController@help')->name('admin.help');

        // -----------------------------
        //      Log Resource
        // -----------------------------
        Route::resource('log', 'AdminLogController', ['names' => [
            'index' => 'admin.log',
            'create' => 'admin.log.create',
            'store' => 'admin.log.store',
            'show' => 'admin.log.show',
            'edit' => 'admin.log.edit',
            'update' => 'admin.log.update',
            'destroy' => 'admin.log.destroy'
        ]]);

        // -----------------------------
        //      IAMMOVIE Resource
        // -----------------------------
        Route::resource('iamovie', 'AdminIammovieController', ['names' => [
            'index' => 'admin.iammovie',
            'create' => 'admin.iammovie.create',
            'store' => 'admin.iammovie.store',
            'show' => 'admin.iammovie.show',
            'edit' => 'admin.iammovie.edit',
            'update' => 'admin.iammovie.update',
            'destroy' => 'admin.iammovie.destroy'
        ]]);

        // -----------------------------
        //      AdminMovie Resource
        // -----------------------------
        Route::resource('movie', 'AdminMovieController', ['names' => [
            'index' => 'admin.movie',
            'create' => 'admin.movie.create',
            'store' => 'admin.movie.store',
            'show' => 'admin.movie.show',
            'edit' => 'admin.movie.edit',
            'update' => 'admin.movie.update',
            'destroy' => 'admin.movie.destroy'
        ]]);

        Route::get('movies', 'AdminMovieController@movies')->name('admin.movie.movies');
        Route::get('searchmovie/{title?}', 'AdminMovieController@movies_search')->name('admin.movie.movies_search');
        Route::get('moviesnew', 'AdminMovieController@movies_new')->name('admin.movie.movies.new');
        Route::get('av', 'AdminMovieController@av')->name('admin.movie.av');
        Route::get('series', 'AdminMovieController@series')->name('admin.movie.series');
        Route::get('seriesonair', 'AdminMovieController@series_onair')->name('admin.movie.series.onair');
        Route::get('seriescomplete', 'AdminMovieController@series_complete')->name('admin.movie.series.complete');
        Route::get('animeonair', 'AdminMovieController@anime_onair')->name('admin.movie.anime.onair');
        Route::get('animecomplete', 'AdminMovieController@anime_complete')->name('admin.movie.anime.complete');



        // -----------------------------
        //      Request Resource
        // -----------------------------
        Route::resource('request', 'AdminRequestController', ['names' => [
            'index' => 'admin.request',
            'create' => 'admin.request.create',
            'store' => 'admin.request.store',
            'show' => 'admin.request.show',
            'edit' => 'admin.request.edit',
            'update' => 'admin.request.update',
            'destroy' => 'admin.request.destroy'
        ]]);

        // -----------------------------
        //      MovieContact แจ้งหนังเสีย
        // -----------------------------
        Route::resource('moviecontact', 'AdminMoviecontactController', ['names' => [
            'index' => 'admin.moviecontact',
            'create' => 'admin.moviecontact.create',
            'store' => 'admin.moviecontact.store',
            'show' => 'admin.moviecontact.show',
            'edit' => 'admin.moviecontact.edit',
            'update' => 'admin.moviecontact.update',
            'destroy' => 'admin.moviecontact.destroy'
        ]]);

        // -----------------------------
        //      Playlist Resource
        // -----------------------------
        Route::resource('playlist', 'AdminPlaylistController', ['names' => [
            'index' => 'admin.playlist',
            'create' => 'admin.playlist.create',
            'store' => 'admin.playlist.store',
            'show' => 'admin.playlist.show',
            'edit' => 'admin.playlist.edit',
            'update' => 'admin.playlist.update',
            'destroy' => 'admin.playlist.destroy'
        ]]);



        // -----------------------------
        //      Category Resource
        // -----------------------------
        Route::resource('category', 'AdminCategoryController', ['names' => [
            'index' => 'admin.category',
            'create' => 'admin.category.create',
            'store' => 'admin.category.store',
            'show' => 'admin.category.show',
            'edit' => 'admin.category.edit',
            'editsplit' => 'admin.category.editsplit',
            'update' => 'admin.category.update',
            'destroy' => 'admin.category.destroy'
        ]]);

        Route::get('categorysplit/create', 'AdminCategoryController@createsplit')->name('admin.category.createsplit');
        Route::get('categorysplit/edit', 'AdminCategoryController@editsplit')->name('admin.category.editsplit');

        // -----------------------------
        //      Member Resource
        //      ยังไม่เปิดให้เพิ่มสมาชิก
        // -----------------------------
        Route::resource('member', 'AdminMemberController', ['names' => [
            'index' => 'admin.member',
            'create' => 'admin.member.create',
            'store' => 'admin.member.store',
            'show' => 'admin.member.show',
            'edit' => 'admin.member.edit',
            'update' => 'admin.member.update',
            'destroy' => 'admin.member.destroy'
        ]]);


        // -----------------------------
        //     Media Resource
        // -----------------------------
        Route::resource('media', 'AdminMediaController', ['names' => [
            'index' => 'admin.media'
        ]]);


        // -----------------------------
        //     Seo Resource
        // -----------------------------
        Route::resource('themesetting', 'AdminThemeController', ['names' => [
            'index' => 'admin.themesetting',
            'create' => 'admin.themesetting.create',
            'store' => 'admin.themesetting.store',
            'show' => 'admin.themesetting.show',
            'edit' => 'admin.themesetting.edit',
            'update' => 'admin.themesetting.update',
            'destroy' => 'admin.themesetting.destroy'
        ]]);
        

        // -----------------------------
        //      Setting Resource
        // -----------------------------
        Route::resource('setting', 'AdminSettingController', ['names' => [
            'index' => 'admin.setting',
            'create' => 'admin.setting.create',
            'store' => 'admin.setting.store',
            'show' => 'admin.setting.show',
            'edit' => 'admin.setting.edit',
            'update' => 'admin.setting.update',
            'destroy' => 'admin.setting.destroy'
        ]]);

        // -----------------------------
        //     Seo Resource
        // -----------------------------
        Route::resource('seo', 'AdminSeoController', ['names' => [
            'index' => 'admin.seo',
            'create' => 'admin.seo.create',
            'store' => 'admin.seo.store',
            'show' => 'admin.seo.show',
            'edit' => 'admin.seo.edit',
            'update' => 'admin.seo.update',
            'destroy' => 'admin.seo.destroy'
        ]]);

        // -----------------------------
        //     Seo Resource
        // -----------------------------
        Route::resource('seo', 'AdminSeoController', ['names' => [
            'index' => 'admin.seo',
            'create' => 'admin.seo.create',
            'store' => 'admin.seo.store',
            'show' => 'admin.seo.show',
            'edit' => 'admin.seo.edit',
            'update' => 'admin.seo.update',
            'destroy' => 'admin.seo.destroy'
        ]]);

        // -----------------------------
        //     Seo Resource
        // -----------------------------
        Route::resource('security', 'AdminSecurityController', ['names' => [
            'index' => 'admin.security',
            'create' => 'admin.security.create',
            'store' => 'admin.security.store',
            'show' => 'admin.security.show',
            'edit' => 'admin.security.edit',
            'update' => 'admin.security.update',
            'destroy' => 'admin.security.destroy'
        ]]);

        // -----------------------------
        //      Settingindex Resource
        // // -----------------------------
        // Route::resource('settingindex', 'AdminSettingindexController', ['names' => [
        //     'index' => 'admin.setting.index',
        //     'create' => 'admin.setting.index.create',
        //     'store' => 'admin.setting.index.store',
        //     'show' => 'admin.setting.index.show',
        //     'edit' => 'admin.setting.index.edit',
        //     'update' => 'admin.setting.index.update',
        //     'destroy' => 'admin.setting.index.destroy'
        // ]]);

        // -----------------------------
        //      Banner Resource
        // -----------------------------
        Route::resource('banner', 'AdminBannerController', ['names' => [
            'index' => 'admin.banner',
            'create' => 'admin.banner.create',
            'store' => 'admin.banner.store',
            'show' => 'admin.banner.show',
            'edit' => 'admin.banner.edit',
            'update' => 'admin.banner.update',
            'destroy' => 'admin.banner.destroy'
        ]]);

        // -----------------------------
        //      Menu Resource
        // -----------------------------
        // Route::resource('menu', 'AdminMenuController', ['names' => [
        //     'index' => 'admin.menu',
        //     'create' => 'admin.menu.create',
        //     'store' => 'admin.menu.store',
        //     'edit' => 'admin.menu.edit',
        //     'update' => 'admin.menu.update',
        //     'destroy' => 'admin.menu.destroy'
        //     ]]);


        // -----------------------------
        //      Menu About
        // -----------------------------
        Route::resource('about', 'AdminAboutController', ['names' => [
            'index' => 'admin.about',
            'create' => 'admin.about.create',
            'store' => 'admin.about.store',
            'edit' => 'admin.about.edit',
            'update' => 'admin.about.update',
            'destroy' => 'admin.about.destroy'
        ]]);

        // -----------------------------
        //      Menu article
        // -----------------------------
        Route::resource('article', 'AdminArticleController', ['names' => [
            'index' => 'admin.article',
            'create' => 'admin.article.create',
            'store' => 'admin.article.store',
            'edit' => 'admin.article.edit',
            'update' => 'admin.article.update',
            'destroy' => 'admin.article.destroy'
        ]]);
    });
});
