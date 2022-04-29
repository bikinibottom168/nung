<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use GuzzleHttp\Client;
use App\Tv;
use App\Setting;

class AdminTvController extends Controller
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
        $data = $this->Main();
        $data['header_title'] = "จัดการTV";
        $data['tv'] = Tv::orderBy('updated_at','desc')->paginate(200);
        return view('admin.page.tv.tv', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->Main();
        $data['header_title'] = "เพิ่มทีวี";
        $data['setting'] = Setting::find(1);
        return view('admin.page.tv.create',$data);
    }

    public function tv_search(Request $request)
    {
        $data = $this->Main();
        $data['header_title'] = $request->title;
        $data['tv'] = Tv::where('title', 'LIKE', '%'.$request->title.'%')->orderBy('updated_at','desc')->paginate(10);
        $data['page'] = 'TV';

        return view('admin.page.tv.tv', $data);
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
        $data = new Tv;
        $data->title = $request->title;
        $data->url = $request->url;
        // $data->url2 = $request->url2;
        // $data->url3 = $request->url3;
        // $data->url4 = $request->url4;
        $data->url_text = $request->url_text;
        // $data->url2_text = $request->url2_text;
        // $data->url3_text = $request->url3_text;
        // $data->url4_text = $request->url4_text;
        $data->random = rand();
        $data->top_channel = 0;
        $data->category = 0;
        $data->status = 1;
        $data->image = '/image/not_found.jpg';

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
            $path = 'images/tv/';
            if(env('APP_ENV') == 'production'){
                $path = 'images/tv/';
            }else if(env('APP_ENV') == 'local'){
                $path = public_path('images/tv/');
            }

            $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            $image_save->make($image->getRealPath())
                ->resize(162,108)
                ->save($path.$newFilename, 90); // ลด Optimize Image
            $data->image = 'images/tv/'.$newFilename;
        }

        $data->save();


        session()->flash('message', 'เพิ่มช่องทีวีเรียบร้อย');
        return redirect()->route('admin.tv');
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
        $data['tv'] = Tv::find($id);
        $data['setting'] = Setting::find(1);
        return view('admin.page.tv.edit', $data);
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
        
        $setting = Setting::find(1);
        $data = Tv::findOrfail($id);
        $data->title = $request->title;
        $data->url = $request->url;
        // $data->url2 = $request->url2;
        // $data->url3 = $request->url3;
        // $data->url4 = $request->url4;
        $data->url_text = $request->url_text;
        // $data->url2_text = $request->url2_text;
        // $data->url3_text = $request->url3_text;
        // $data->url4_text = $request->url4_text;
        $data->random = rand();
        $data->top_channel = 0;
        $data->category = 0;
        $data->status = 1;
        //จะแปลงข้อมูลให้เป็น {{}}
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
            $path = 'images/tv/';
            if(env('APP_ENV') == 'production'){
                $path = 'images/tv/';
            }else if(env('APP_ENV') == 'local'){
                $path = public_path('images/tv/');
            }

            $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            $image_save->make($image->getRealPath())
                ->resize(162,108)
                ->save($path.$newFilename, 90); // ลด Optimize Image
            $data->image = 'images/tv/'.$newFilename;
        }

        $data->update();


        session()->flash('message', 'แก้ไขช่องทีวีเรียบร้อย');
        return redirect()->route('admin.tv');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Tv::find($id)->delete();

        session()->flash('message', 'ลบเรียบร้อย');
        return redirect()->route('admin.tv');
    }
}
