<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use App\Setting;
use App\Playlist;
use Auth;

class AdminPlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin');
    }


     public function Main()
     {
         $data['infosetting'] = Setting::first();
         return $data;
     }


    public function index()
    {
        if(!Auth::check())
        {
            return redirect()->route('admin.login');
        }

        $data = $this->Main();
        $data['header_title'] = "Playlist";
        // $data['request'] = category::where('split', '0')->orderBy('created_at', 'asc')->get();
        $data['request'] = Playlist::orderBy('created_at', 'asc')->get();

        // $data['request_split'] = category::where('split', '1')->orderBy('created_at', 'asc')->get();

        return view('admin.page.playlist.playlist', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->Main();
        $data['header_title'] = "เพิ่ม Playlist";
        return view('admin.page.playlist.create', $data);
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

        $title = explode(" ",$request->title);
        $title = implode("-",$title);
        $title = explode("(",$title);
        $title = implode("",$title);
        $title = explode(")",$title);
        $title = implode("",$title);
        $title = explode(".",$title);
        $title = implode("",$title);

        $play_temp = array();
        // Insert Database
        $data = new Playlist;
        $data->title = $request->title;
        $data->slug_title = $title;
        $data->playlist = json_encode($play_temp);
        if($request->hasFile('image_poster')){
            $image = $request->file('image_poster');
            $filename = $image->getClientOriginalName();
            $newFilename = str_random(11).str_random(20).$filename;
            $newFilename = str_replace(' ','_',$newFilename);
            $path = 'images/playlist/';
            if(env('APP_ENV') == 'production'){
                $path = 'images/playlist/';
            }else if(env('APP_ENV') == 'local'){
                $path = public_path('images/playlist/');
            }
            $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            $image_save->make($image->getRealPath())
                ->resize(230,341)
                ->save($path.$newFilename, 100); // ลด Optimize Image
            $data->image = 'images/playlist/'.$newFilename;
        }
        $data->save();

        log_post("Create","เพิ่ม Playlist $data->title",Auth::user()->email);
        session()->flash('message', "เพิ่ม Playlist สำเร็จ");
        return redirect()->route('admin.playlist');
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
        $data['request'] = Playlist::find($id);
        $data['header_title'] = "แก้ไข Playlist";

        return view('admin.page.playlist.edit', $data);
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


        $title = explode(" ",$request->title);
        $title = implode("-",$title);
        $title = explode("(",$title);
        $title = implode("",$title);
        $title = explode(")",$title);
        $title = implode("",$title);
        $title = explode(".",$title);
        $title = implode("",$title);

        $data = Playlist::find($id);
        $data->slug_title = $title;
        if($request->hasFile('image_poster')){
            $image = $request->file('image_poster');
            $filename = $image->getClientOriginalName();
            $newFilename = str_random(11).str_random(20).$filename;
            $newFilename = str_replace(' ','_',$newFilename);
            $path = 'images/playlist/';
            if(env('APP_ENV') == 'production'){
                $path = 'images/playlist/';
            }else if(env('APP_ENV') == 'local'){
                $path = public_path('images/playlist/');
            }
            $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            $image_save->make($image->getRealPath())
                ->resize(230,341)
                ->save($path.$newFilename, 100); // ลด Optimize Image
            $data->image = 'images/playlist/'.$newFilename;
        }
        $data->save();

        log_post("Update","อัพเดท Playlist $data->title",Auth::user()->email);

        session()->flash('message', "แก้ไข Playlist สำเร็จ");
        return redirect()->route('admin.playlist');
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
        
        $data = Playlist::where('id',$id)->delete();

        log_post("Delete","ลบ Playlist $id",Auth::user()->email);

        session()->flash('message', 'ลบเรียบร้อย');
        return redirect()->route('admin.playlist');
    }
}
