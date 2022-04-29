<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Response;
use App\About as menu;
use App\movie;
use App\genre;
use App\Setting;
use App\Playlist;
use App\Categorys_movies as categoryMovies;
// use App\About as about;
use App\Tv;
use App\Ad as ads;
use App;
use Carbon\Carbon;
use App\User;
use Jenssegers\Agent\Agent;
use Tholu\Packer\Packer;
use Crypt;
use App\Seo;
use Redirect;
use App\Article;
use App\Option;

// Scaping
use GuzzleHttp\Client as GuzzleClient;
use Goutte\Client;


// Check Table
use App\Http\Controllers\CheckTableController as checkTable;
use App\Http\Controllers\VideoController as Streaming;

class MovieController extends Controller
{

  public function __construct()
  {
    $this->middleware('install');
  }
  
  // Set Data;
  public $data;
  public $i = 0;
  public $k = 0;


  public function Main()
  {
    $check_table = new checkTable();
    $data['setting'] = Setting::find(1);
    $data['seo'] = Seo::first();
    $data['category_type'] = genre::where([['type_category', 'type']])
      ->orderBy('title_category_eng', 'asc')->get();
    $data['category_menu'] = genre::where('type_category', 'category')->orderBy('title_category_eng', 'asc')->get();
    // Category List and SUM item;
    $data['category'] = genre::join('categorys_movies', 'genres.id', '=', 'categorys_movies.category_id')
      ->select('genres.title_category', 'genres.title_category_eng', DB::raw('count(*) as total'))
      ->groupBy('genres.title_category', 'genres.title_category_eng')
      ->orderBy('genres.title_category_eng', 'ASC')
      ->get();

    $data['playlist'] = Playlist::orderBy('title', 'ASC')->get();

    $data['movie_hot'] = movie::inRandomOrder()->limit(16)->get();

    $data['menu_category'] = menu::where('abouts.type', '1')
      ->join('genres', 'abouts.description', '=', 'genres.id')
      ->orderBy('abouts.id', 'ASC')->get();

    $data['menu_url'] = menu::where('type', '2')
      ->orderBy('abouts.id', 'ASC')->get();


    $data['mode'] = "home";
    $data['mode_sub'] = "movie";
    $data['title'] = $data['setting']->title;
    $data['description'] = $data['setting']->description;
    $data['category_year'] = movie::orderBy('year', 'desc')->first();

    // #################
    //      Show Ads
    // #################
    if (\Request::route()->getName() == "home") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "top_imdb") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "much_like") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "movie_year") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "movie_tag") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "category" || \Request::route()->getName() == "playlist") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "movie") {
      $data['show_ads'] = "2";
    } else if (\Request::route()->getName() == "search") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "letters") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "letters_number") {
      $data['show_ads'] = "1";
    } else if (\Request::route()->getName() == "article" || \Request::route()->getName() == "article.all") {
      $data['show_ads'] = "1";
    } else {
      $data['show_ads'] = "1";
    }

    $data['ads_a'] = ads::where([
      ['layout_ads', '=', 'a'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'asc')
      ->get(); // ตรงกลางด้านบน

    // แสดงหลายๆอัน

    $data['ads_video_ads_content'] = ads::where([
      ['layout_ads', '=', 'video_ads_content'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->get(); // ขวาด้านบน

    $data['ads_r1'] = ads::where([
      ['layout_ads', '=', 'r1'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->get(); // ขวาด้านบน

    $data['ads_f1'] = ads::where([
      ['layout_ads', '=', 'f1'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->get(); // ซ้ายด้านบน

    $data['ads_bbb'] = ads::where([
      ['layout_ads', '=', 'bbb'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->get(); // ลอยตรงกลางล่าง

    $data['ads_aaa'] = ads::where([
      ['layout_ads', '=', 'aaa'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->get(); // ลอยซ้าย

    $data['ads_ccc'] = ads::where([
      ['layout_ads', '=', 'ccc'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->get(); // ลอยขวา

    $data['ads_footer'] = ads::where([
      ['layout_ads', '=', 'footer'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->get(); // ลอยขวา

    $data['ads_r2'] = ads::where([
      ['layout_ads', '=', 'r2'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'asc')
      ->get(); // 250px ข้างๆ
    $data['ads_code'] = ads::where([
      ['layout_ads', '=', 'code'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'asc')
      ->get();

    return $data;
  }

  public function index(Request $request)
  {
    if (!Schema::hasTable('settings')) {
      return redirect()->route('install');
    }

    $data = $this->Main(); // Main มาใช้

    if ($request->page) {
      $data['title'] = "หน้า " . $request->page . " - " . $data['setting']->title;
    } else {
      $data['title'] = $data['setting']->title;
    }
    $data['keywords'] = $data['setting']->keyword;
    $data['description'] = $data['setting']->description;
    $data['news'] = Article::orderBy('updated_at', 'desc')->paginate(12);

    $data['movie'] = movie::orderBy('updated_at', 'desc')
      ->select('id', 'title', 'slug_title', 'sound', 'image', 'imdb', 'resolution', 'type', 'movie_hot', 'score', 'updated_at')
      ->paginate(40)
      ->onEachSide(1);


    return view('movie.home', $data);
  }

  public function overlay()
  {
    $data['result'] = ads::where([
      ['layout_ads', '=', 'overlay'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->first();
    return response()->view('overlay', $data)->header('Content-Type', 'text/xml');
  }

  public function news($title)
  {
    $data = $this->Main(); // Main มาใช้

    if(option_get('article_type') == "title" || option_get('article_type') == false)
    {
      $data['news'] = Article::where('slug_title', $title)->firstOrFail();
    }
    else 
    {
      $data['news'] = Article::where('id', $title)->firstOrFail();
    }
    
    $data['news']->view = $data['news']->view + 1;
    $data['news']->timestamps = false;
    $data['news']->save();

    $data['title'] = $data['news']->title . " " . $data['setting']->title;
    $data['description'] = $data['news']->title . " " . $data['setting']->title;


    $data['keywords'] = $data['setting']->keyword;
    $data['description'] = $data['setting']->description;

    return view('article.article', $data);
  }

  public function news_all(Request $request)
  {
    $data = $this->Main(); // Main มาใช้

    $data['news'] = Article::orderBy('updated_at', 'desc')->paginate(12);
    $data['keywords'] = $data['setting']->keyword;

    if ($request->page) {
      $data['title'] = "บทความทั้งหมด หน้า " . $request->page . " - " . $data['setting']->title;
      $data['description'] = "บทความทั้งหมด หน้า " . $request->page . " - " . $data['setting']->title;
    } else {
      $data['title'] = "บทความทั้งหมด" . $data['setting']->title;
      $data['description'] = $data['setting']->title;
    }



    return view('article.article_all', $data);
  }

  public function letters(Request $request)
  {

    $data = $this->Main(); // Main มาใช้

    if ($request->page) {
      $data['title'] = "$request->letters | หน้า " . $request->page . " - " . $data['setting']->title;
    } else {
      $data['title'] = $request->letters . " | " . $data['setting']->title;
    }

    $data['keywords'] = $request->letters . " | " . $data['setting']->keyword;
    $data['description'] = $request->letters . " | " . $data['setting']->description;

    $data['letter_list'] = movie::where('title', 'like', $request->letters . "%")
      ->orderBy('view', 'desc')
      ->select('id', 'title', 'slug_title', 'sound', 'image', 'imdb', 'resolution', 'type', 'movie_hot', 'score')
      ->paginate(36)
      ->onEachSide(1);


    return view('movie.letter', $data);
  }

  public function letters_number(Request $request)
  {

    $data = $this->Main(); // Main มาใช้

    if ($request->page) {
      $data['title'] = "0-9 | หน้า " . $request->page . " - " . $data['setting']->title;
    } else {
      $data['title'] = "0-9 | " . $data['setting']->title;
    }

    $data['keywords'] = "0-9 | " . $data['setting']->keyword;
    $data['description'] = "0-9 | " . $data['setting']->description;

    $data['letter_list'] = movie::orderBy('view', 'desc')
      ->select('id', 'title', 'slug_title', 'sound', 'image', 'imdb', 'resolution', 'type', 'movie_hot', 'score')
      ->paginate(36)
      ->onEachSide(1);


    return view('movie.letter', $data);
  }

  // Streaming MP4 JWPLAYER
  public function streaming($url)
  {

    $data = $this->Main(); // Main มาใช้
    $check_http = strpos(Crypt::decryptString(base64_decode($url)), "http");
    if ($check_http !== false) {
      $sources = $this->get_cloudstream(Crypt::decryptString(base64_decode($url)), false);
    } else {
      $sources = $this->get_cloudstream(Crypt::decryptString(base64_decode($url)), true);
    }
    $data['url'] = $url;

    $url = "var url = '" . $sources . "';";
    $packer = new Packer($url, 'Normal', true, false, true);
    // $data['sources'] = $packer->pack();
    $data['sources'] = $url;


    // // url สำหรับดึง token
    // $url_api = url('api/v1/get/token/wmsauth');
    // $url_api = "var api_token = '".$url_api."';";
    // $data['api_token'] = new Packer($url_api, 'Normal', true, false, true);
    // $data['api_token'] = $data['api_token']->pack();


    // $data['url'] = route('streaming.file', ['file' => $url]);

    if (env('VIDEO_PLAYER', 'jwplayer') == "videojs") {

      $jw = 'var player = videojs("hlsjslive");
            player.src({
                src: url,
                type: "application/x-mpegURL"
            });';
    } else {
      $jw = 'jwplayer.key = "ITWMv7t88JGzI0xPwW8I0+LveiXX9SWbfdmt0ArUSyc=";
                jwplayer("hlsjslive").setup({
                file: url,
                width:"100%",
                aspectratio: "16:9",
                primary : "html5",
                preload: "auto",
                advertising: {
                    "client": "vast",
                    "adscheduleid": "Az87bY12",
                    "schedule": [
                        {
                            "tag": "' . url('ads/overlay.xml') . '"
                        }    
                    ]
                }
                });
            ';
    }
    $packer_jw = new Packer($jw, 'Normal', true, false, true);
    $data['jw'] = $jw;
    // $data['jw'] = $packer_jw->pack();

    return view('template.movie.streaming', $data);
  }

  // =======================================
  //      Protect Streaming
  // =======================================
  public function get_cloudstream($url, $includ_env = false)
  {
    $video_url = $url;
    $get_routes = Setting::first();
    if ($get_routes->streaming_2 != null)
    {
      if ($includ_env) {
          // $video_url = base64_decode(env('STREAMING_ID_URL', '')).$url."/playlist.m3u8";
          $check_http = strpos($url, "ssd/");
          if ($check_http === false) {
            // $video_url = base64_decode(env('STREAMING_ID_URL', '')).$url."";
            $video_url = $get_routes->streaming_2. $url . "/playlist.m3u8";
          } else {
            // $video_url = base64_decode(env('STREAMING_ID_URL_SSD', '')).$url."";
            $video_url = $get_routes->streaming_1 . $url . "/playlist.m3u8";
          }
      }
    }
    else
    {
      if ($includ_env) {
          // $video_url = base64_decode(env('STREAMING_ID_URL', '')).$url."/playlist.m3u8";
          $check_http = strpos($url, "ssd/");
          if ($check_http === false) {
            // $video_url = base64_decode(env('STREAMING_ID_URL', '')).$url."";
            $video_url = base64_decode(env('STREAMING_ID_URL', '')) . $url . "/playlist.m3u8";
          } else {
            // $video_url = base64_decode(env('STREAMING_ID_URL_SSD', '')).$url."";
            $video_url = base64_decode(env('STREAMING_ID_URL_SSD', '')) . $url . "/playlist.m3u8";
          }
      }
    }

    $today = gmdate("n/j/Y g:i:s A");
    // dd($today);
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"])) {
      $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
      $ip = $_SERVER['HTTP_X_REAL_IP'];
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      $commapos = strrpos($ip, ',');
      $ip = trim(substr($ip, $commapos ? $commapos + 1 : 0));
    }
    $id = "";
    $key = "0ea631f7f57f39d8272eaa86deb97abaa"; //enter your key here
    $validminutes = 20;
    $str2hash = $ip . $key . $today . $validminutes;
    $md5raw = md5($str2hash, true);
    $base64hash = base64_encode($md5raw);
    $urlsignature = "server_time=" . $today . "&hash_value=" . $base64hash . "&validminutes=$validminutes";
    $base64urlsignature = base64_encode($urlsignature);

    $final_url = $video_url . "?wmsAuthSign=" . $base64urlsignature;
    return $final_url;
  }

  public function movie_tag($title)
  {
    $data = $this->Main(); // Main มาใช้


    $data['movie'] = movie::where('slug_title', $title)->paginate(28);
    $data['description'] = $title . " :TAG | " . $data['setting']->title;
    $data['title'] = $title . " :TAG | " . $data['setting']->title;


    return view('movie.home', $data);
  }


  public function movie($title)
  {
    $data = $this->Main(); // Main มาใช้

    if(option_get('movie_type') == "title" || option_get('movie_type') == false)
    {
      $data['movie'] = movie::where('slug_title', $title)->firstOrFail(); // ค้นหาหนัง
    }
    else 
    {
      $data['movie'] = movie::where('id', $title)->firstOrFail(); // ค้นหาหนัง
    }


    $data['movie']->view = $data['movie']->view + 1;
    $data['movie']->timestamps = false;
    $data['movie']->update();
    if ($data['movie'] == false) {
      return redirect()->route('home');
    }


    // SEO
    // $data['title'] = $data['movie']->title." - ".$data['setting']->title;
    $data['title'] = "";
    $data['title'] = str_replace("{movie_title}", $data['movie']->title, $data['seo']->seo_title);
    $data['title'] = str_replace("{title_web}", $data['setting']->title, $data['title']);
    // END SEO


    // SEO
    $data['description'] = "";
    $data['description'] = str_replace("{movie_title}", $data['movie']->title, $data['seo']->seo_description_type);
    $data['description'] = str_replace("{title_web}", $data['setting']->title, $data['description']);
    $data['description'] = str_replace("{movie_description}", $data['movie']->description, $data['description']);
    // END SEO


    $data['genre'] = categoryMovies::where('categorys_movies.movie_id', $data['movie']->id)
      ->join('genres', 'genres.id', '=', 'categorys_movies.category_id')
      ->orderBy('genres.title_category_eng', 'asc')->get(); // ค้นหาหมวดหมู่แรกของหนัง

    // dd($data['genre']);
    $data['genre_count'] = categoryMovies::where('categorys_movies.movie_id', $data['movie']->id)
      ->join('genres', 'genres.id', '=', 'categorys_movies.category_id')
      ->orderBy('genres.title_category_eng', 'asc')->count();


    // โฆษณา
    $data['ads_movie_top'] = ads::where([
      ['layout_ads', '=', 'm1'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->get(); // หน้าดูหนังด้านบน
    $data['ads_movie_bottom'] = ads::where([
      ['layout_ads', '=', 'm2'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->get(); // หน้าดูหนังด้านล่าง
    $data['ads_movie_video'] = ads::where([
      ['layout_ads', 'video'],
      ['expired', '>', Carbon::now()],
      ['status_ads', '=', 1]
    ])
      ->orderBy('position', 'asc')
      ->get(); // VIDEO ADS
    $data['ads_movie_vast'] = ads::where([
      ['layout_ads', 'vast'],
      ['expired', '>', Carbon::now()],
      ['status_ads', '=', 1]
    ])
      ->orderBy('position', 'asc')
      ->first(); // VIDEO ADS
    $data['ads_movie_video_count'] = ads::where([
      ['layout_ads', 'video'],
      ['expired', '>', Carbon::now()],
      ['status_ads', '=', 1]
    ])
      ->count(); // COUNT VIDEO ADS

    $data['ads_mt'] = ads::where([
      ['layout_ads', '=', 'mt'],
      ['status_ads', '=', 1],
      ['expired', '>', Carbon::now()]
    ])
      ->orderBy('position', 'desc')
      ->orderBy('updated_at', 'desc')
      ->get(); // ลอยขวา

    $data['random_movie'] = movie::orderByRaw("RAND()")->limit(6)->get(); // สุ่มหนัง

    return view('movie.movie', $data);
  }


  public function movies()
  {
    $data = $this->Main(); // Main มาใช้


    $data['mode'] = "movie";
    $data['movie'] = movie::orderBy('new_movie', '1')
      ->orderBy('updated_at', 'desc')
      ->paginate(36);
    $data['title_category'] = 'หนังทั้งหมด';
    $data['title'] = "หนังทั้งหมด " . $data['setting']->title;
    $data['keywords'] = $data['setting']->title;
    $data['description'] = $data['setting']->description;

    $data['random_movie'] = movie::orderByRaw("RAND()")->limit(4)->get(); // สุ่มหนัง
    return view('movie.category', $data);
  }

  public function year($year)
  {
    $data = $this->Main(); // Main มาใช้

    $data['movie'] = movie::where('year',$year)->paginate(36);
    $data['category_select'] = "ปี $year";
    $data['title_category_eng'] = "ปี $year";


    return view('movie.category', $data);
  }

  public function category($title, Request $request)
  {
    $data = $this->Main(); // Main มาใช้

    $data['category_select'] = genre::where('title_category', str_replace('-', ' ', $title))->first();
    if (!$data['category_select']) {
      $data['category_select'] = genre::where('title_category_eng', str_replace('-', ' ', $title))->firstOrFail();
    }


    if ($request->page) {
      $data['title'] = $data['category_select']->title_category_eng . " - " . $data['category_select']->title_category . " หน้า " . $request->page . " - " . $data['setting']->title;
      $data['description'] = $data['category_select']->title_category_eng . " - " . $data['category_select']->title_category . " หน้า " . $request->page . " - " . $data['setting']->title;
    } else {
      $data['title'] = $data['category_select']->title_category_eng . " - " . $data['category_select']->title_category . " " . $data['setting']->title;
      $data['description'] = $data['category_select']->title_category_eng . " - " . $data['category_select']->title_category . " " . $data['setting']->title;
    }


    $data['movie'] = categoryMovies::where('categorys_movies.category_id', $data['category_select']->id)
      ->join('movies', 'categorys_movies.movie_id', '=', 'movies.id')
      ->orderBy('movies.created_at', 'desc')
      ->paginate(36);


    return view('movie.category', $data);
  }

  public function playlist($title, Request $request)
  {
    $data = $this->Main(); // Main มาใช้

    $data['get_playlist'] = Playlist::where('slug_title', $title)->firstOrFail();

    if ($request->page) {
      $data['title'] = $data['get_playlist']->title . " หน้า " . $request->page . " - " . $data['setting']->title;
      $data['description'] = $data['get_playlist']->title . " หน้า " . $request->page . " - " . $data['setting']->title;
    } else {
      $data['title'] = $data['get_playlist']->title . " " . $data['setting']->title;
      $data['description'] = $data['get_playlist']->title . " " . $data['setting']->title;
    }


    // $data['movie'] = categoryMovies::where('categorys_movies.category_id', $data['get_playlist']->id)
    //     ->join('movies','categorys_movies.movie_id', '=','movies.id')
    //     ->orderBy('movies.created_at','desc')
    //     ->paginate(36);
    $playlist = (array) json_decode($data['get_playlist']->playlist);

    $data['movie'] = movie::whereIn('id', $playlist)
      ->paginate(36);


    return view('movie.playlist', $data);
  }
  public function category_series($id, $title)
  {
    $data = $this->Main(); // Main มาใช้

    $data['mode'] = "movie";
    $data['movie'] = categoryMovies::where('categorys_movies.category_id', $id)
      ->join('movies', 'categorys_movies.movie_id', '=', 'movies.id')
      ->where('movies.type', 'series')
      ->orderBy('movies.created_at', 'desc')
      ->paginate(28);
    $data['title_category'] = $title;
    $data['title'] = $data['setting']->title;
    $data['keywords'] = $data['setting']->title;
    $data['description'] = $data['setting']->description;
    return view('movie.category_series', $data);
  }

  public function search(Request $request)
  {
    $data = $this->Main(); // Main มาใช้


    $data['search'] = $request->title;

    $data['movie'] = movie::where('title', 'like', '%' . $request->title . '%')
      ->orderBy('updated_at', 'desc')
      ->paginate(36);

    return view('movie.search', $data);
  }

  public function ads_redirect(Request $request)
  {
    $get_ads = ads::where('id', $request->id)->first();
    $ads = ads::where('id', $request->id)->first();
    $ads->timestamps = false;
    $ads->count_click = $get_ads->count_click + 1;
    $ads->update();

    return Redirect::to($ads->url_ads, 301);
  }
}
