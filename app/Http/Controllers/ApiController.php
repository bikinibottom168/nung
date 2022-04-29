<?php

namespace App\Http\Controllers;

use App\Categorys_movies as categoryMovies;
use App\Collection;
use App\Expire;
use App\genre;
use App\movie;
use App\Moviecontact as moviecon;
use App\Pincode as pin;
use App\Playlist;
use App\Request as req;
use App\Setting;
use App\Tv as tv;
use App\User as user;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManager;
use Tholu\Packer\Packer;

class ApiController extends Controller
{
    // #################################
    // API UPDATE สำหรับสคริป IAMTHEME
    // ##################################
    public function movie_api($token)
    {
        $check = '$2y$12$OdGqawUNroxW1FBAz4PF8OfmexfSeyDLE1SmF4.iMFBqKTrrF9kC6';
        if (Hash::check($token, $check)) {
            $movie_all = movie::where('api_update', 0)->orderBy('id', 'desc');

            $movie_get = $movie_all->paginate(900);

            return json_encode($movie_get);
        }
    }

    public function description()
    {
        $data = movie::where('description', 'not like', '%ดูหนังออนไลน์%')->limit(100)->get();

        foreach ($data as $k) {
            $update = movie::find($k->id);
            $update->description = 'ดูหนังออนไลน์ '.$update->title.' | '.$update->description;
            $update->save();
            echo $update->title."\n";
        }
    }

    // GET TOKEN WMSAUTH
    public function get_token($ip)
    {
        $today = gmdate('n/j/Y g:i:s A');
        $ip = $ip;
        $id = '';
        $key = env('STREAMING_KEY', ''); //enter your key here
        $validminutes = 20;
        $str2hash = $ip.$key.$today.$validminutes;
        $md5raw = md5($str2hash, true);
        $base64hash = base64_encode($md5raw);
        $urlsignature = 'server_time='.$today.'&hash_value='.$base64hash."&validminutes=$validminutes";
        $base64urlsignature = '?wmsAuthSign='.base64_encode($urlsignature);

        return response()->json([
            'token' => $base64urlsignature,
        ]);
    }

    // #################################
    // API UPDATE
    // ##################################
    public function api($token_hash)
    {
        if ($token_hash != '353890') {
            return abort(404, 'Page Not Found');
        }

        $domain = '';
        if (env('SCRIPT_TYPE', 'movie') == 'movie') {
            $domain = 'https://api.vip-streaming.com/';
        } elseif (env('SCRIPT_TYPE', 'movie') == 'av') {
            $domain = 'https://av.iamtheme.com/';
        } elseif (env('SCRIPT_TYPE', 'movie') == 'anime' || env('SCRIPT_TYPE', 'movie') == 'series') {
            $domain = 'https://anime.iamtheme.com/';
        }

        $client = new Client;
        $response = $client->request('GET', $domain.'api/v1/movie/353890', ['http_errors' => false]);
        $get = json_decode($response->getBody());
        foreach ($get->data as $k) {
            $check = Movie::where('id', $k->id);

            // มีหนังอยู่แล้ว
            if ($check->count() >= 1) {
                $checkDeleteDuplicate = Movie::where([['slug_title', $k->slug_title], ['id', '!=', $k->id]])->delete();

                $check_version = $check->first();
                // if($check_version->version != $k->version)
                // {
                // อัพเดทข้อมูล เช่น ซีรี่ย์ Epison
                if ($check_version->image != $k->image) {
                    $part = $domain.$k->image;
                    // $input = Input::file($part);
                    $file = file_get_contents($part);
                    $save = file_put_contents($k->image, $file);
                    // $test = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
                        // $test->make($part)
                        //     ->save($k->image);
                }

                $movie = Movie::find($k->id);

                // ถ้า resolution เหมือนเดิมไม่ต้องอัพเดท timestamps
                if ($k->resolution == $movie->resolution) {
                    $movie->timestamps = false;
                } else {
                    // ถ้า resolution มีการอัพเดทให้การอัพเดท
                    $movie->timestamps = false;
                    $movie->created_at = Carbon::now();
                }

                $movie->title = $k->title;
                $movie->slug_title = $k->slug_title;
                $movie->new_movie = 0;
                $movie->type = $k->type;
                $movie->description = $k->description;
                $movie->youtube = $k->youtube;
                $movie->onair = $k->onair;
                $movie->actors = $k->actors;
                $movie->year = $k->year;
                $movie->imdb = $k->imdb;
                $movie->score = $k->score;
                $movie->resolution = $k->resolution;
                $movie->sound = $k->sound;
                $movie->runtime = $k->runtime;
                $movie->vip = 1;
                $movie->api_update = 1;
                $movie->image = $k->image;
                $movie->image_poster = $k->image_poster;
                $movie->file_main = $k->file_main;
                $movie->file_main_2 = $k->file_main_2;
                $movie->file_main_3 = $k->file_main_3;
                $movie->file_openload = $k->file_openload;
                $movie->file_openload_2 = $k->file_openload_2;
                $movie->file_openload_3 = $k->file_openload_3;
                $movie->file_streamango = $k->file_streamango;
                $movie->file_streamango_2 = $k->file_streamango_2;
                $movie->file_streamango_3 = $k->file_streamango_3;
                $movie->file_main_sub = $k->file_main_sub;
                $movie->file_main_sub_2 = $k->file_main_sub_2;
                $movie->file_main_sub_3 = $k->file_main_sub_3;
                $movie->file_openload_sub = $k->file_openload_sub;
                $movie->file_openload_sub_2 = $k->file_openload_sub_2;
                $movie->file_openload_sub_3 = $k->file_openload_sub_3;
                $movie->file_streamango_sub = $k->file_streamango_sub;
                $movie->file_streamango_sub_2 = $k->file_streamango_sub_2;
                $movie->file_streamango_sub_3 = $k->file_streamango_sub_3;
                $movie->file_series = $k->file_series;
                $movie->save();
            } else { // ไม่มีหนัง
                $movie = new Movie;
                $movie->id = $k->id;
                $movie->title = $k->title;
                $movie->slug_title = $k->slug_title;
                $movie->new_movie = 0;
                $movie->type = $k->type;
                $movie->description = $k->description;
                $movie->youtube = $k->youtube;
                $movie->onair = $k->onair;
                $movie->actors = $k->actors;
                $movie->year = $k->year;
                $movie->imdb = $k->imdb;
                $movie->score = $k->score;
                $movie->resolution = $k->resolution;
                $movie->sound = $k->sound;
                $movie->runtime = $k->runtime;
                $movie->vip = 1;
                $movie->api_update = 1;
                $movie->image = $k->image;
                $movie->image_poster = $k->image_poster;
                $movie->file_main = $k->file_main;
                $movie->file_main_2 = $k->file_main_2;
                $movie->file_main_3 = $k->file_main_3;
                $movie->file_openload = $k->file_openload;
                $movie->file_openload_2 = $k->file_openload_2;
                $movie->file_openload_3 = $k->file_openload_3;
                $movie->file_streamango = $k->file_streamango;
                $movie->file_streamango_2 = $k->file_streamango_2;
                $movie->file_streamango_3 = $k->file_streamango_3;
                $movie->file_main_sub = $k->file_main_sub;
                $movie->file_main_sub_2 = $k->file_main_sub_2;
                $movie->file_main_sub_3 = $k->file_main_sub_3;
                $movie->file_openload_sub = $k->file_openload_sub;
                $movie->file_openload_sub_2 = $k->file_openload_sub_2;
                $movie->file_openload_sub_3 = $k->file_openload_sub_3;
                $movie->file_streamango_sub = $k->file_streamango_sub;
                $movie->file_streamango_sub_2 = $k->file_streamango_sub_2;
                $movie->file_streamango_sub_3 = $k->file_streamango_sub_3;
                $movie->file_series = $k->file_series;
                $movie->save();
            }

            if ($k->image != '') {
                $part = $domain.$k->image;
                // $test = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
                // $test->make($part)
                //     ->save($k->image);
                $file = file_get_contents($part);
                $save = file_put_contents($k->image, $file);
            }

            echo "<a href='".route('movie', ['title' => $k->slug_title])."' target='_blank'>".$k->id.': '.$k->title.'</a><br>';
        }
    }

    // #################################
    // API UPDATE SEO
    // ##################################
    public function seo($key, Request $request)
    {
        $update_last = Setting::first();
        $client = new Client;

        $domain = 'https://client.iamtheme.com/';
        // CATEGOTY CHECK
        $category_all = genre::get();
        if (count($category_all) == 0) {
            $response = $client->request('GET', $domain."api/v1/category/$request->key", ['http_errors' => false]);
            $get = json_decode($response->getBody());

            foreach ($get->data as $item) {
                $add_category = new genre;
                $add_category->id = $item->id;
                $add_category->title_category = $item->title_category;
                $add_category->title_category_eng = $item->title_category_eng;
                $add_category->type_category = $item->type_category;
                $add_category->no = $item->no;
                $add_category->split = $item->split;
                $add_category->save();
            }
        }

        $domain = 'https://client.iamtheme.com/';

        if (! Schema::hasColumn('settings', 'streaming_1')) {
            $response = $client->request('GET', $domain."api/v1/info/$request->key", ['http_errors' => false]);
            $get = json_decode($response->getBody(), true);

            Schema::table('settings', function ($table) {
                $table->text('streaming_1')->nullable();
                $table->text('streaming_2')->nullable();
            });

            $routes = unserialize($get['data']['routes']['option_value']);
            $update_last = Setting::first();
            $update_last->streaming_1 = trim($routes['0']);
            $update_last->streaming_2 = trim($routes['1']);
            $update_last->save();
        }

        $response = $client->request('GET', $domain."api/v1/data/$request->key?page=$update_last->last_seo", ['http_errors' => false]);
        $get = json_decode($response->getBody());

        foreach ($get->data as $k) {
            $check = Movie::where('id', $k->id);

            // มีหนังอยู่แล้ว
            if ($check->count() >= 1) {
                $checkDeleteDuplicate = Movie::where([['slug_title', $k->slug_title], ['id', '!=', $k->id]])->delete();

                $check_version = $check->first();
                // if($check_version->version != $k->version)
                // {
                // อัพเดทข้อมูล เช่น ซีรี่ย์ Epison
                if ($check_version->image != $k->image) {
                    $part = $domain.$k->image;

                    $part = str_replace(' ', '%20', $part);

                    // $input = Input::file($part);
                    $file = file_get_contents($part);
                    $save = file_put_contents($k->image, $file);
                    // $test = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
                        // $test->make($part)
                        //     ->save($k->image);
                }

                $movie = Movie::find($k->id);

                // ถ้า resolution เหมือนเดิมไม่ต้องอัพเดท timestamps
                if ($k->resolution == $movie->resolution) {
                    $movie->timestamps = false;
                } else {
                    // ถ้า resolution มีการอัพเดทให้การอัพเดท
                    $movie->timestamps = false;
                    $movie->created_at = Carbon::now();
                }

                $movie->title = $k->title;
                $movie->slug_title = $k->slug_title;
                $movie->new_movie = 0;
                $movie->type = $k->type;
                $movie->description = $k->description;
                $movie->youtube = $k->youtube;
                $movie->onair = $k->onair;
                $movie->actors = $k->actors;
                $movie->year = $k->year;
                $movie->imdb = $k->imdb;
                $movie->score = $k->score;
                $movie->resolution = $k->resolution;
                $movie->sound = $k->sound;
                $movie->runtime = $k->runtime;
                $movie->vip = 1;
                // $movie->api_update = 1;
                $movie->image = $k->image;
                $movie->image_poster = $k->image_poster;
                $movie->file_main = $k->file_main;
                $movie->file_main_2 = $k->file_main_2;
                $movie->file_main_3 = $k->file_main_3;
                $movie->file_openload = $k->file_openload;
                $movie->file_openload_2 = $k->file_openload_2;
                $movie->file_openload_3 = $k->file_openload_3;
                $movie->file_streamango = $k->file_streamango;
                $movie->file_streamango_2 = $k->file_streamango_2;
                $movie->file_streamango_3 = $k->file_streamango_3;
                $movie->file_main_sub = $k->file_main_sub;
                $movie->file_main_sub_2 = $k->file_main_sub_2;
                $movie->file_main_sub_3 = $k->file_main_sub_3;
                $movie->file_openload_sub = $k->file_openload_sub;
                $movie->file_openload_sub_2 = $k->file_openload_sub_2;
                $movie->file_openload_sub_3 = $k->file_openload_sub_3;
                $movie->file_streamango_sub = $k->file_streamango_sub;
                $movie->file_streamango_sub_2 = $k->file_streamango_sub_2;
                $movie->file_streamango_sub_3 = $k->file_streamango_sub_3;
                $movie->file_series = $k->file_series;
                $movie->save();
            } else { // ไม่มีหนัง
                $movie = new Movie;
                $movie->id = $k->id;
                $movie->title = $k->title;
                $movie->slug_title = $k->slug_title;
                $movie->new_movie = 0;
                $movie->type = $k->type;
                $movie->description = $k->description;
                $movie->youtube = $k->youtube;
                $movie->onair = $k->onair;
                $movie->actors = $k->actors;
                $movie->year = $k->year;
                $movie->imdb = $k->imdb;
                $movie->score = $k->score;
                $movie->resolution = $k->resolution;
                $movie->sound = $k->sound;
                $movie->runtime = $k->runtime;
                $movie->vip = 1;
                // $movie->api_update = 1;
                $movie->image = $k->image;
                $movie->image_poster = $k->image_poster;
                $movie->file_main = $k->file_main;
                $movie->file_main_2 = $k->file_main_2;
                $movie->file_main_3 = $k->file_main_3;
                $movie->file_openload = $k->file_openload;
                $movie->file_openload_2 = $k->file_openload_2;
                $movie->file_openload_3 = $k->file_openload_3;
                $movie->file_streamango = $k->file_streamango;
                $movie->file_streamango_2 = $k->file_streamango_2;
                $movie->file_streamango_3 = $k->file_streamango_3;
                $movie->file_main_sub = $k->file_main_sub;
                $movie->file_main_sub_2 = $k->file_main_sub_2;
                $movie->file_main_sub_3 = $k->file_main_sub_3;
                $movie->file_openload_sub = $k->file_openload_sub;
                $movie->file_openload_sub_2 = $k->file_openload_sub_2;
                $movie->file_openload_sub_3 = $k->file_openload_sub_3;
                $movie->file_streamango_sub = $k->file_streamango_sub;
                $movie->file_streamango_sub_2 = $k->file_streamango_sub_2;
                $movie->file_streamango_sub_3 = $k->file_streamango_sub_3;
                $movie->file_series = $k->file_series;
                $movie->save();
            }

            if ($k->image != '') {
                $part = $domain.$k->image;
                $part = str_replace(' ', '%20', $part);
                // $test = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
                // $test->make($part)
                //     ->save($k->image);
                $file = file_get_contents($part);
                $save = file_put_contents($k->image, $file);
            }

            // category update
            $movie_id_array = [];
            if (! empty($k->category_movie)) {
                foreach ($k->category_movie as $item_category) {
                    if ($item_category->movie_id != null && $item_category->category_id != null) { // ข้อมูลต้องไม่ว่าง
                        if (! in_array($item_category->movie_id, $movie_id_array)) {
                            DB::table('categorys_movies')->where('movie_id', $item_category->movie_id)->delete();
                            array_push($movie_id_array, $item_category->movie_id);
                        }

                        $movie = new categoryMovies;
                        $movie->movie_id = $item_category->movie_id;
                        $movie->category_id = $item_category->category_id;
                        // $movie->api_update = 1;
                        $movie->save();
                    }
                }
            }

            echo "<a href='".route('movie', ['title' => $k->slug_title])."' target='_blank'>".$k->id.': '.$k->title.'</a><br>';
        }

        //update last seo page
        $update_last->last_seo = $update_last->last_seo + 1;
        $update_last->save();
    }

    public function api_category($token_hash)
    {
        if ($token_hash != '353890') {
            return abort(404, 'Page Not Found');
        }

        $domain = '';
        if (env('SCRIPT_TYPE', 'movie') == 'movie') {
            $domain = 'https://api.vip-streaming.com/';
        } elseif (env('SCRIPT_TYPE', 'movie') == 'av') {
            $domain = 'https://av.iamtheme.com/';
        } elseif (env('SCRIPT_TYPE', 'movie') == 'anime' || env('SCRIPT_TYPE', 'movie') == 'series') {
            $domain = 'https://anime.iamtheme.com/';
        }

        $client = new Client;
        $response = $client->request('GET', $domain.'api/v1/movie-category/353890', ['http_errors' => false]);
        $get = json_decode($response->getBody());

        $movie_id_array = [];

        foreach ($get->data as $k) {
            if (! in_array($k->movie_id, $movie_id_array)) {
                // $update = categoryMovies::where('movie_id', $k->movie_id)->delete();
                DB::table('categorys_movies')->where('movie_id', $k->movie_id)->delete();
                array_push($movie_id_array, $k->movie_id);
            }

            $movie = new categoryMovies;
            // $movie->id = $k->id;
            $movie->movie_id = $k->movie_id;
            $movie->category_id = $k->category_id;
            $movie->api_update = 1;
            $movie->save();
        }

        echo 'SUCCESS | UPDATE';
    }

    public function update_playlist($id_playlist, $id_movie, $token)
    {
        $user = user::where('remember_token', $token)->first();
        if ($user) {
            if ($id_playlist == -1) {
                // Delete Exist Other Playlist
                $playlist_delete = Playlist::get();
                foreach ($playlist_delete as $key) {
                    $result_delete = (array) json_decode($key->playlist);
                    $key_delete = array_search($id_movie, $result_delete);
                    if ($key_delete !== false) {
                        // ลบออกจาก Array
                        unset($result_delete[$key_delete]);
                        // จัดการ index array ใหม่ ป้องกัน Error
                        $movie_array_for_index = array_values($result_delete);
                        // Update
                        $update_delete = Playlist::find($key->id);
                        $update_delete->playlist = json_encode($movie_array_for_index);
                        $update_delete->save();
                    }
                }

                return 'Success|DELETE';
            } else {
                $playlist = Playlist::find($id_playlist);
                $result = (array) json_decode($playlist->playlist);
                // Find Array Movie ID
                $find_result = array_search($id_movie, $result);

                // If find
                if ($find_result === false) {
                    // Delete Exist Other Playlist
                    $playlist_delete = Playlist::get();
                    foreach ($playlist_delete as $key) {
                        $result_delete = (array) json_decode($key->playlist);
                        $key_delete = array_search($id_movie, $result_delete);
                        if ($key_delete !== false) {
                            // ลบออกจาก Array
                            unset($result_delete[$key_delete]);

                            // จัดการ index array ใหม่ ป้องกัน Error
                            $movie_array_for_index = array_values($result_delete);

                            // Update
                            $update_delete = Playlist::find($key->id);
                            $update_delete->playlist = json_encode($movie_array_for_index);
                            $update_delete->save();
                        }
                    }

                    // Push Array New value
                    $result_push = array_push($result, $id_movie);
                    // Update
                    $playlist->playlist = json_encode($result);
                    $playlist->save();

                    return 'Success|UPDATE';
                }
            }

            return 'Error|Exist';
        }
    }

    protected function request($title)
    {
        $request = new req;
        $request->title = $title;
        $request->status = 0;
        $request->save();

        echo 'เราจะดำเนินการให้เร็วที่สุด';
    }

    protected function moviecontact($movieid)
    {
        $check = moviecon::where('movie_id', $movieid);
        if ($check->count() <= 0) {
            $request = new moviecon;
            $request->movie_id = $movieid;
            // $request->user_id = $userid;
            // $request->url_error = base64_decode($url);
            $request->save();
        }

        echo 'เราจะดำเนินการให้เร็วที่สุด';
    }
}
