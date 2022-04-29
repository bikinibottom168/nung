<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Setting;
use App\tmpay;
use App\CategoryTv;
use App\Seo;
use URL;

class InstallController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Schema::hasTable('settings')){
            return redirect()->route('home');
        }
        return view('install');
    }



    public function store(Request $request)
    {
        // // ======================================
        // //      สร้าง Table Users
        // // ======================================
        //     Schema::create('users', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->string('email')->nullable();
        //         $table->string('password')->nullable();
        //         $table->integer('admin')->default(0);
        //         $table->datetime('vip')->nullable();
        //         $table->integer('login_expire')->default(0);
        //         $table->integer('status_login')->default(0);
        //         $table->string('ip', 50)->nullable();
        //         $table->rememberToken();
        //         $table->timestamps();
        //     });
        //     // เพิ่ม User Admin
        //     $data['admin'] = new User;
        //     $data['admin']->email = $request->username_admin;
        //     $data['admin']->password = Hash::make($request->password_admin);
        //     $data['admin']->admin = 1;
        //     $data['admin']->vip = "2025-01-01 01:00:00";
        //     $data['admin']->save();
        
        // // ======================================
        // //      สร้าง Table menu
        // // ======================================
        // Schema::create('tvs', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title')->nullable();
        //     $table->text('url')->nullable();
        //     $table->text('category')->nullable();
        //     $table->text('top_channel')->nullable();
        //     $table->text('image')->nullable();
        //     $table->text('status')->nullable();
        //     $table->timestamps();
        // });

        // // ======================================
        // //      สร้าง Table about
        // // ======================================
        // Schema::create('abouts', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title')->nullable();
        //     $table->text('description')->nullable();
        //     $table->text('type')->nullable();
        //     $table->timestamps();
        // });

        // // ======================================
        // //      สร้าง Table about
        // // ======================================
        // Schema::create('articles', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title')->nullable();
        //     $table->string('slug_title')->nullable();
        //     $table->text('description')->nullable();
        //     $table->integer('type')->nullable();
        //     $table->integer('view')->nullable();
        //     $table->text('image')->nullable();
        //     $table->timestamps();
        // });
        
        // // ======================================
        // //      สร้าง Table Playlist
        // // ======================================
        // Schema::create('playlists', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title')->nullable();
        //     $table->text('slug_title')->nullable();
        //     $table->text('playlist')->nullable();
        //     $table->text('image')->nullable();
        //     $table->timestamps();
        // });

        // // ======================================
        // //      สร้าง Table menu
        // // ======================================
        //     Schema::create('menus', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->string('title')->nullable();
        //         $table->text('url')->nullable();
        //         $table->integer('no')->nullable();
        //         $table->timestamps();
        //     });

        // // ======================================
        // //      สร้าง Table Request
        // // ======================================
        //     Schema::create('requests', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->string('title',100)->nullable();
        //         // $table->integer('user_id')->nullable();
        //         $table->integer('status')->default(0);
        //         $table->timestamps();
        //     });



        // // ======================================
        // //      สร้าง Table Movie
        // // ======================================
        //     Schema::create('movies', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->text('title')->nullable();
        //         $table->text('slug_title')->nullable();
        //         $table->text('new_movie')->nullable();
        //         $table->text('type')->nullable();
        //         $table->integer('onair')->default(0);
        //         $table->text('description')->nullable();
        //         // $table->text('url')->nullable();
        //         // $table->text('url2')->nullable();
        //         // $table->text('url3')->nullable();
        //         $table->text('file_main')->nullable();
        //         $table->text('file_main_2')->nullable();
        //         $table->text('file_main_3')->nullable();
        //         $table->text('file_openload')->nullable();
        //         $table->text('file_openload_2')->nullable();
        //         $table->text('file_openload_3')->nullable();
        //         $table->text('file_streamango')->nullable();
        //         $table->text('file_streamango_2')->nullable();
        //         $table->text('file_streamango_3')->nullable();
        //         $table->text('file_main_sub')->nullable();
        //         $table->text('file_main_sub_2')->nullable();
        //         $table->text('file_main_sub_3')->nullable();
        //         $table->text('file_openload_sub')->nullable();
        //         $table->text('file_openload_sub_2')->nullable();
        //         $table->text('file_openload_sub_3')->nullable();
        //         $table->text('file_streamango_sub')->nullable();
        //         $table->text('file_streamango_sub_2')->nullable();
        //         $table->text('file_streamango_sub_3')->nullable();
        //         $table->text('file_series')->nullable();
        //         $table->text('youtube')->nullable();
        //         $table->string('sound',20)->nullable();
        //         $table->text('image')->nullable();
        //         $table->text('image_poster')->nullable();
        //         $table->text('vip')->nullable();
        //         $table->text('runtime')->nullable();
        //         $table->text('year')->nullable();
        //         $table->text('imdb')->nullable();
        //         $table->text('resolution')->nullable();
        //         $table->text('view')->nullable();
        //         $table->text('director')->nullable();
        //         $table->text('actors')->nullable();
        //         $table->string('api_update')->default(0);
        //         $table->integer('start_play')->default(0);
        //         $table->integer('movie_hot')->default(0);
        //         $table->float('score')->default(0)->nullable();
        //         $table->timestamps();
        //     });


        // // ======================================
        // //      สร้าง Table banners Ads
        // // ======================================
        //     Schema::create('ads', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->text('title_ads')->nullable();
        //         $table->text('count_click')->nullable();
        //         $table->text('show_ads')->nullable();
        //         $table->text('position')->nullable();
        //         $table->text('url_ads')->nullable();
        //         $table->text('status_button')->nullable();
        //         $table->text('image_ads')->nullable();
        //         $table->string('layout_ads', 10)->nullable();
        //         $table->integer('status_ads')->default(0);
        //         $table->string('number_ads', 10)->default(0);
        //         $table->text('expired')->nullable();
        //         $table->text('button')->nullable();
        //         $table->text('type')->nullable();
        //         $table->timestamps();
        //     });

        // // ======================================
        // //      สร้าง Table moviecontact แจ้งหนังเสีย
        // // ======================================
        // Schema::create('moviecontacts', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('movie_id')->nullable();
        //     $table->timestamps();
        // });

        // // ======================================
        // //      สร้าง Table categorys_movies
        // // ======================================
        //     Schema::create('categorys_movies', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->integer('movie_id')->unsigned()->default(1)->nullable();
        //         $table->foreign('movie_id')
        //             ->references('id')->on('movies')
        //             ->onDelete('cascade');
        //         $table->integer('category_id')->unsigend()->default(1)->nullable();
        //         $table->timestamps();
        // });

        // // ======================================
        // //      สร้าง Table genres
        // // ======================================
        //     Schema::create('genres', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->string('title_category',200)->nullable();
        //         $table->string('title_category_eng',200)->nullable();
        //         $table->text('no')->nullable();
        //         $table->string('type_category',100)->nullable();
        //         $table->string('type_source',100)->nullable();
        //         $table->string('split',100)->default("0");
        //         $table->timestamps();
        //     });

        // // ======================================
        // //      สร้าง Table settings
        // // ======================================
        //     Schema::create('settings', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->integer('ssl')->default(0);
        //         $table->text('domain')->nullable();
        //         $table->text('title')->nullable();
        //         $table->text('description')->nullable();
        //         $table->text('keyword')->nullable();
        //         $table->integer('comment_fb')->default(1)->nullable();
        //         $table->text('logo')->nullable();
        //         $table->text('icon')->nullable();
        //         $table->text('facebook')->nullable();
        //         $table->text('twitter')->nullable();
        //         $table->integer('imdb')->default('0')->nullable();
        //         $table->integer('time_skip')->default('3');
        //         $table->string('tmpay', 15)->nullable();
        //         $table->text('header')->nullable();
        //         $table->text('footer')->nullable();
        //         $table->text('text_index')->nullable();
        //         $table->string('banner_status')->default('1');
        //         $table->string('last_seo')->default('1');
        //         // $table->text('texthome')->nullable();
        //         // $table->text('textrun')->nullable();
        //         // $table->text('textrun_color')->nullable();
        //         // $table->string('verify', 10)->nullable();
        //         // $table->integer('facebook_login')->default(1);
        //         // $table->integer('verify_expire')->nullable();
        //         $table->timestamps();
        //     });
        // //   เพิ่มข้อมูลเว็บ
        //     $data['setting'] = new Setting;
        //     $data['setting']->domain = URL::to('/');
        //     $data['setting']->title = "IAMTHEME สคริปเว็บดูหนัง";
        //     $data['setting']->description = "IAMTHEME สคริปเว็บดูหนัง";
        //     // $data['setting']->textrun = "IAMTHEME สคริปเว็บดูหนัง";
        //     // $data['setting']->textrun_color = "#ff0000";
        //     $data['setting']->keyword = "IAMTHEME สคริปเว็บดูหนัง";
        //     $data['setting']->facebook = "";
        //     $data['setting']->twitter = "";
        //     $data['setting']->imdb = 0;
        //     $data['setting']->save();

        
        // // ======================================
        // //      สร้าง Table Seo
        // // ======================================
        // Schema::create('seos', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->text('seo_title')->nullable();
        //     $table->text('seo_description_type')->nullable();
        //     $table->text('front_seo')->nullable();
        //     $table->timestamps();
        // });
        // //   เพิ่มข้อมูลเว็บ
        //     $data['seo'] = new Seo;
        //     $data['seo']->seo_title = "{movie_title} - {title_web}";
        //     $data['seo']->seo_description_type = "ดูหนังออนไลน์ {movie_title} หนังออนไลน์ใหม่ หนังมาสเตอร์ เสียงไทยมาสเตอร์ ดูผ่านมือถือ";
        //     $data['seo']->save();

        // // ======================================
        // //      สร้าง Tags
        // // ======================================
        //     Schema::create('log', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->integer('movie_iid_tag')->nullable();
        //         $table->string('slug_title_tag', 100)->nullable();
        //         $table->timestamps();
        //     });

        //     return redirect()->route('admin.login');
    }


}
