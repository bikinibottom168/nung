<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\movie;
use App\genre;
use App\Setting;
use App\Seo;
use App\Playlist;
use App\Categorys_movies as categorys;
use Intervention\Image\ImageManager;
use GuzzleHttp\Client;
use Auth;
use App\Http\Controllers\CheckTableController as checkTable;

class AdminMovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $check = new checkTable;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function Main()
     {

         $data['infosetting'] = Setting::first();
         $data['seo'] = Seo::first();
         return $data;
     }

    public function index()
    {
        if(!Auth::check())
        {
            return redirect()->route('admin.login');
        }

        $data = $this->Main();
        $data['header_title'] = "จัดการหนัง";
        $data['movie'] = movie::orderBy('updated_at','desc')->paginate(10);
        $data['playlist'] = Playlist::orderBy('title','asc')->get();
        $data['page'] = 'movie';
        return view('admin.page.movie.movie', $data);
    }

    public function movies()
    {
        $data = $this->Main();
        $data['header_title'] = "จัดการหนัง - หนังทั้งหมด";
        $data['movie'] = movie::where('type', 'movie')->orderBy('updated_at','desc')->paginate(10);
        $data['page'] = 'movies';

        return view('admin.page.movie.movie', $data);
    }

    public function series()
    {
        $data = $this->Main();
        $data['header_title'] = "จัดการซีรี่ย์";
        $data['movie'] = movie::where('type', 'series')->orderBy('updated_at','desc')->paginate(10);
        $data['page'] = 'movies';

        return view('admin.page.movie.movie', $data);
    }

    public function movies_search(Request $request)
    {
        $data = $this->Main();
        $data['header_title'] = $request->title;
        $data['movie'] = movie::where('title', 'LIKE', '%'.$request->title.'%')->orderBy('updated_at','desc')->paginate(10);
        $data['playlist'] = Playlist::orderBy('title','asc')->get();
        $data['page'] = 'movies';

        return view('admin.page.movie.movie', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->Main();
        $data['header_title'] = "เพิ่มหนัง";
        $data['category'] = genre::orderBy('title_category_eng', 'asc')->get();
        $data['setting'] = Setting::find(1);
        return view('admin.page.movie.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(env("DEMO",'0') == "1")
        {
            return redirect()->back();
        }

        $setting = Setting::find(1);
        $title = explode(" ",$request->title);
        $title = implode("-",$title);
        $title = explode("(",$title);
        $title = implode("",$title);
        $title = explode(")",$title);
        $title = implode("",$title);

        $check_title = movie::where('slug_title', $title);

        if($check_title->count() >= 1)
        {
            $title = mb_substr($title, 0, 15, "UTF-8"); // ตัดสตริงออก 1 ตัว
        }

        $youtube = '';
        if(strrpos($request->youtube, 'watch?v='))
        {
            $youtube = explode("watch?v=", $request->youtube);
            $youtube = $youtube[1];
        }
        elseif(strrpos($request->youtube, 'embed/'))
        {
            $youtube = explode("/embed/", $request->youtube);
            $youtube = $youtube[1];
        }
        elseif(strrpos($request->youtube, 'youtu.be/'))
        {
            $youtube = explode("youtu.be/", $request->youtube);
            $youtube = $youtube[1];
        }

        $data = new movie;
        $data->title = $request->title;
        $data->slug_title = $title;
        $data->youtube = $youtube;
        $data->description = $request->description;
        $data->year = $request->year;
        $data->type = $request->list_check;
        $data->resolution = $request->resolution;
        $data->movie_hot = isset($request->movie_hot) ? $request->movie_hot : 0  ;
        // $data->vip = '0';
        $data->sound = $request->sound;
        // $data->runtime = '0';
        // $data->new_movie = $request->new_movie;
        if($setting->imdb == "1")
        {
            $data->imdb = $request->imdb;
        }
        else
        {
            $data->score = $request->score;
            $data->runtime = $request->runtime;
            $data->director = $request->director;
            $data->actors = $request->actors;
        }

        // $data->type = $request->type;
        // $data->onair = $request->onair;
        $data->image = '/image/not_found.jpg';
        // $data->view = '0';
        $filemovie1 = '';
        if($data->type == "movie")
        {
            $data->file_main = $request->file_main_1;
            $data->file_main_2 = $request->file_main_2;
            $data->file_main_3 = $request->file_main_3;
    
            $data->file_openload = $request->file_openload_1;
            $data->file_openload_2 = $request->file_openload_2;
            $data->file_openload_3 = $request->file_openload_3;
    
            $data->file_streamango = $request->file_streamango_1;
            $data->file_streamango_2 = $request->file_streamango_2;
            $data->file_streamango_3 = $request->file_streamango_3;
            // Sub
            $data->file_main_sub = $request->file_main_sub_1;
            $data->file_main_sub_2 = $request->file_main_sub_2;
            $data->file_main_sub_3 = $request->file_main_sub_3;
    
            $data->file_openload_sub = $request->file_openload_sub_1;
            $data->file_openload_sub_2 = $request->file_openload_sub_2;
            $data->file_openload_sub_3 = $request->file_openload_sub_3;
    
            $data->file_streamango_sub = $request->file_streamango_sub_1;
            $data->file_streamango_sub_2 = $request->file_streamango_sub_2;
            $data->file_streamango_sub_3 = $request->file_streamango_sub_3;
        }
        else if($data->type == "series")
        {
            // $filemovie2 = '';
            // $filemovie3 = '';
            for($i=0; $i< $request->countFile; $i++){
                $name = 'nameFile'.$i;

                $url1 = 'urlFile1_'.$i;
                // $url2 = 'urlFile2_'.$i;
                // $url3 = 'urlFile3_'.$i;
                $filemovie1 .= '{{'.$request->$name.'}}'.$request->$url1.'!!end!!';
                // $filemovie2 .= '{{'.$request->$name.'}}'.$request->$url2.'!!end!!';
                // $filemovie3 .= '{{'.$request->$name.'}}'.$request->$url3.'!!end!!';
            }
        }

        $data->file_series = $filemovie1;

        

    

        // ==============================================================
        //
        // ถ้ามีการอัพรูป จะ resize
        //
        // ==============================================================
        if($request->hasFile('file')){
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();
            $newFilename = str_random(11).str_random(20).$filename;
            $newFilename = str_replace(' ','_',$newFilename);
            // ========================================
            // หากเป็น Product จะไม่ใช้ public_path();
            // ========================================
            $path = 'images/movie/';
            if(env('APP_ENV') == 'production'){
                $path = 'images/movie/';
            }else if(env('APP_ENV') == 'local'){
                $path = public_path('images/movie/');
            }
            $image->move($path, $newFilename);
            // $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            // $image_save->make($image->getRealPath())
            //     ->resize(230,341)
            //     ->save($path.$newFilename, 90); // ลด Optimize Image
            $data->image = 'images/movie/'.$newFilename;
        }

        // ภาพหน้าปก POSTER
        if($request->hasFile('file_poster')){
            $image_2 = $request->file('file_poster');
            $filename_2 = $image_2->getClientOriginalName();
            $newFilename_2 = str_random(11).str_random(20).$filename_2;
            $newFilename_2 = str_replace(' ','_',$newFilename_2);
            // ========================================
            // หากเป็น Product จะไม่ใช้ public_path();
            // ========================================
            $path = 'images/movie/';
            if(env('APP_ENV') == 'production'){
                $path = 'images/movie/';
            }else if(env('APP_ENV') == 'local'){
                $path = public_path('images/movie/');
            }
            $image_2->move($path, $newFilename);
            // $image_save_2 = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            // $image_save_2->make($image_2->getRealPath())
            //     ->save($path.$newFilename_2, 90); // ลด Optimize Image
            $data->image_poster = 'images/movie/'.$newFilename_2;
        }
        // ==============================================================
        // กรณีมีการใช้ IMDB
        // $setting->imdb == 1 เช็คว่าเปิดให้ใส่ imdb หรือไม่
        // ==============================================================
        if(strpos($request->imdb, "tt") !== false && $setting->imdb == 1){

            // ==============================================================
            //
            // GuzzleHttp เป็น plugin ในการดึงข้อมูลหน้าเว็บหรือ JsonData
            // use GuzzleHttp/Client | ดึง Library มาใช้งาน
            // composer require guzzle/guzzle | คำสั่งในการ Install ผ่าน Composer
            //
            // ==============================================================

            $client = new Client;
            $res = $client->request('GET', 'http://www.imdb.com/title/'.$request->imdb.'/', ['http_errors' => false]);

            if($res->getStatusCode() != "404" || $res->getStatusCode() != "403" || $res->getStatusCode() != "500" || $res->getStatusCode() != "502" || $res->getStatusCode() != "503")
            {
                $getBody = $res->getBody();
                $getBody = urldecode($getBody);
                preg_match('/ratingValue": "(.*?)"/', $getBody, $score);
                if(!empty($score[1]))
                {
                    $data->score = $score[1];
                }

            }
            // preg_match('/<time itemprop="duration" datetime="PT(.*?)M">/', $getBody, $runtime);
            // $data->runtime = $runtime[1][0]." นาที";
            $data->runtime = "0 นาที";
        }

        $data->save();

        // ==============================================================
        //
        // เช็คว่าเลือกหมวดหมู่กี่อัน
        // $tem_ca เช็คว่าเลือกซ้ำกันไหม
        //
        // ==============================================================
        $countCate = 0;
        $data = Movie::orderBy('created_at','desc')->first();
        $tem_ca = '';
        $delete_data_category_movie = categorys::where('movie_id',$data->id)->delete(); //ลบหมวดหมู่เก่าออกก่อน
        $request->category = array_unique($request->category);
        foreach($request->category as $tmp_category)
        {
            if($tmp_category != 0){
                $data_cate = new categorys;
                $data_cate->category_id = $tmp_category;
                $data_cate->movie_id = $data->id;
                $data_cate->save();
            }
            $tem_ca = $request->category1;
        }
        // ==============================================================
        //
        // เอา Categorys ออกจาก เพื่อเพิ่มใหม่
        //
        // ==============================================================
        // for($i=0; $i< $countCate; $i++){
        //     if($i == 0){
        //         $category = $request->category1;
        //     }
        //     else if($i == 1)
        //     {
        //         $category = $request->category2;
        //     }
        //     else
        //     {
        //         $category = $request->category3;
        //     }
        //     $data_cate = new categorys;
        //     $data_cate->category_id = $category;
        //     $data_cate->movie_id = $id;
        //     $data_cate->save();
        // }
        log_post("Create","เพิ่มหนัง $data->title",Auth::user()->email);

        session()->flash('message', 'เพิ่มหนังเรียบร้อย');
        return redirect()->route('admin.movie');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->Main();
        $data['header_title'] = "แก้ไขหนัง";
        $data['movie'] = movie::find($id);
        $data['category'] = genre::orderBy('title_category_eng', 'asc')->get();
        $data['setting'] = Setting::find(1);
        $data['selected'] = $data['movie']->CategoryMovie()->where('movie_id',$data['movie']->id)->orderBy('updated_at', 'desc')->limit(6)->get();
        return view('admin.page.movie.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(env("DEMO",'0') == "1")
        {
            return redirect()->back();
        }

        if(env("DEMO",'0') == "1")
        {
            return redirect()->back();
        }
        
        $setting = Setting::find(1);
        $title = explode(" ",$request->title);
        $title = implode("-",$title);
        $title = explode("(",$title);
        $title = implode("",$title);
        $title = explode(")",$title);
        $title = implode("",$title);
        $title = explode(".",$title);
        $title = implode("",$title);

        $check_title = movie::where('slug_title', $title);

        if($check_title->count() >= 2)
        {
            $title = mb_substr($title, 0, 15, 'UTF-8'); // ตัดสตริงออก
        }

        $youtube = '';
        if(strrpos($request->youtube, 'watch?v='))
        {
            $youtube = explode("watch?v=", $request->youtube);
            $youtube = $youtube[1];
        }
        elseif(strrpos($request->youtube, 'embed/'))
        {
            $youtube = explode("/embed/", $request->youtube);
            $youtube = $youtube[1];
        }
        elseif(strrpos($request->youtube, 'youtu.be/'))
        {
            $youtube = explode("youtu.be/", $request->youtube);
            $youtube = $youtube[1];
        }
        
        
        $data = movie::findOrfail($id);
        $data->title = $request->title;
        $data->slug_title = $title;
        $data->youtube = $youtube;
        $data->description = $request->description;
        $data->api_update = 0;
        $data->movie_hot = isset($request->movie_hot) ? $request->movie_hot : 0  ;

        $filemovie1 = '';
        if($data->type == "movie")
        {
            $data->file_main = $request->file_main_1;
            $data->file_main_2 = $request->file_main_2;
            $data->file_main_3 = $request->file_main_3;
    
            $data->file_openload = $request->file_openload_1;
            $data->file_openload_2 = $request->file_openload_2;
            $data->file_openload_3 = $request->file_openload_3;
    
            $data->file_streamango = $request->file_streamango_1;
            $data->file_streamango_2 = $request->file_streamango_2;
            $data->file_streamango_3 = $request->file_streamango_3;
            // Sub
            $data->file_main_sub = $request->file_main_sub_1;
            $data->file_main_sub_2 = $request->file_main_sub_2;
            $data->file_main_sub_3 = $request->file_main_sub_3;
    
            $data->file_openload_sub = $request->file_openload_sub_1;
            $data->file_openload_sub_2 = $request->file_openload_sub_2;
            $data->file_openload_sub_3 = $request->file_openload_sub_3;
    
            $data->file_streamango_sub = $request->file_streamango_sub_1;
            $data->file_streamango_sub_2 = $request->file_streamango_sub_2;
            $data->file_streamango_sub_3 = $request->file_streamango_sub_3;
        }
        else if($data->type == "series")
        {
            // $filemovie2 = '';
            // $filemovie3 = '';
            for($i=0; $i< $request->countFile; $i++){
                $name = 'nameFile'.$i;

                $url1 = 'urlFile1_'.$i;
                // $url2 = 'urlFile2_'.$i;
                // $url3 = 'urlFile3_'.$i;
                $filemovie1 .= '{{'.$request->$name.'}}'.$request->$url1.'!!end!!';
                // $filemovie2 .= '{{'.$request->$name.'}}'.$request->$url2.'!!end!!';
                // $filemovie3 .= '{{'.$request->$name.'}}'.$request->$url3.'!!end!!';
            }
        }

        $data->file_series = $filemovie1;


        $data->year = $request->year;
        if($setting->imdb == "1")
        {
            $data->imdb = $request->imdb;
        }
        else
        {
            $data->score = $request->score;
            $data->runtime = $request->runtime;
        }
        // $data->new_movie = $request->new_movie;
        // $data->score;
        // $data->vip = '0';
        $data->sound = $request->sound;
        $data->type = $request->list_check;
        // $data->type = $request->type;
        // $data->onair = $request->onair;
        $data->resolution = $request->resolution;
        // ==============================================================
        // กรณีมีการใช้ IMDB
        // $setting->imdb == 1 เช็คว่าเปิดให้ใส่ imdb หรือไม่
        // ==============================================================
        if(strpos($request->imdb, "tt") !== false && $setting->imdb == 1){

            // ==============================================================
            //
            // GuzzleHttp เป็น plugin ในการดึงข้อมูลหน้าเว็บหรือ JsonData
            // use GuzzleHttp/Client | ดึง Library มาใช้งาน
            // composer require guzzle/guzzle | คำสั่งในการ Install ผ่าน Composer
            //
            // ==============================================================

            $client = new Client;
            $res = $client->request('GET', 'http://www.imdb.com/title/'.$request->imdb.'/', ['http_errors' => false]);
            if($res->getStatusCode() != "404" || $res->getStatusCode() != "403" || $res->getStatusCode() != "500" || $res->getStatusCode() != "502" || $res->getStatusCode() != "503")
            {
                $getBody = $res->getBody();
                $getBody = urldecode($getBody);
                preg_match('/ratingValue": "(.*?)"/', $getBody, $score);
                if(!empty($score[1]))
                {
                    $data->score = $score[1];
                }

            }
            // preg_match('/<time itemprop="duration" datetime="PT(.*?)M">/', $getBody, $runtime);
            // $data->runtime = $runtime[1][0]." นาที";
            $data->runtime = "0 นาที";
        }
        //จะแปลงข้อมูลให้เป็น {{}}

        // $data->url2 = '0';
        // $data->url3 = '0';
        // $filemovie1 = '';
        // // $filemovie2 = '';
        // // $filemovie3 = '';
        // for($i=0; $i< $request->countFile; $i++){
        //     $name = 'nameFile'.$i;
        //     $url1 = 'urlFile1_'.$i;
        //     // $url2 = 'urlFile2_'.$i;
        //     // $url3 = 'urlFile3_'.$i;
        //     $filemovie1 .= '{{'.$request->$name.'}}'.$request->$url1.'!!end!!';
        //     // $filemovie2 .= '{{'.$request->$name.'}}'.$request->$url2.'!!end!!';
        //     // $filemovie3 .= '{{'.$request->$name.'}}'.$request->$url3.'!!end!!';
        // }

        // $data->url = $filemovie1;
        // // $data->url2 = $filemovie2;
        // // $data->url3 = $filemovie3;

        // // ==============================================================
        // //
        // // ถ้ามีการอัพรูป จะ resize
        // //
        // // ==============================================================
        if($request->hasFile('file')){
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();
            $newFilename = str_random(11).str_random(20).$filename;
            $newFilename = str_replace(' ','_',$newFilename);
            $path = 'images/movie/';
            if(env('APP_ENV') == 'production'){
                $path = 'images/movie/';
            }else if(env('APP_ENV') == 'local'){
                $path = public_path('images/movie/');
            }
            $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            $image_save->make($image->getRealPath())
                ->resize(230,341)
                ->save($path.$newFilename, 90); // ลด Optimize Image
            $data->image = 'images/movie/'.$newFilename;
        }

        // ภาพหนังปกหนัง
        if($request->hasFile('file_poster')){
            $image = $request->file('file_poster');
            $filename = $image->getClientOriginalName();
            $newFilename = str_random(11).str_random(20).$filename;
            $newFilename = str_replace(' ','_',$newFilename);
            $path = 'images/movie/';
            if(env('APP_ENV') == 'production'){
                $path = 'images/movie/';
            }else if(env('APP_ENV') == 'local'){
                $path = public_path('images/movie/');
            }
            $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            $image_save->make($image->getRealPath())
                ->save($path.$newFilename, 90); // ลด Optimize Image
            $data->image_poster = 'images/movie/'.$newFilename;
        }

        $data->update($request->all());

        // ==============================================================
        //
        // เช็คว่าเลือกหมวดหมู่กี่อัน
        // $tem_ca เช็คว่าเลือกซ้ำกันไหม
        //
        // ==============================================================
        // $countCate = 0;
        // $tem_ca = '';
        // if($request->category1 != 0){
        //     $countCate++;
        //     $tem_ca = $request->category1;
        // }
        // if($request->category2 != 0 && $request->category2 != $tem_ca){
        //     $countCate++;
        //     $tem_ca = $request->category2;
        // }
        // if($request->category3 != 0 && $request->category3 != $tem_ca){
        //     $countCate++;
        // }
        // ==============================================================
        //
        // เอา Categorys ออกจาก เพื่อเพิ่มใหม่
        //
        // ==============================================================
        $delete_data_category_movie = categorys::where('movie_id',$data->id)->delete(); //ลบหมวดหมู่เก่าออกก่อน
        $request->category = array_unique($request->category);
        foreach($request->category as $tmp_category)
        {
            if($tmp_category != 0){
                $data_cate = new categorys;
                $data_cate->category_id = $tmp_category;
                $data_cate->movie_id = $data->id;
                $data_cate->save();
            }
        }
        // for($i=0; $i< $countCate; $i++){
        //     if($i == 0){
        //         $category = $request->category1;
        //     }
        //     else if($i == 1)
        //     {
        //         $category = $request->category2;
        //     }
        //     else
        //     {
        //         $category = $request->category3;
        //     }
        //     $data_cate = new categorys;
        //     $data_cate->category_id = $category;
        //     $data_cate->movie_id = $id;
        //     $data_cate->save();
        // }

        log_post("Update","อัพเดทหนัง $data->title",Auth::user()->email);

        session()->flash('message', 'แก้ไขหนังเรียบร้อย');
        return redirect()->route('admin.movie');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(env("DEMO",'0') == "1")
        {
            return redirect()->back();
        }
        
        $data = movie::find($id)->delete();

        log_post("Delete","ลบหนัง $id",Auth::user()->email);

        session()->flash('message', 'ลบเรียบร้อย');
        return redirect()->route('admin.movie');
    }
}
