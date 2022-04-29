<?php

namespace App\Http\Controllers;

use App\Ad as banner;
use App\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class AdminBannerController extends Controller
{
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
        if (! Auth::check()) {
            return redirect()->route('admin.login');
        }

        $data = $this->Main();
        $data['header_title'] = 'จัดการโฆษณา';
        $data['request'] = banner::where('layout_ads', '!=', 'video')->orderBy('created_at', 'desc')->get();
        $data['request_video'] = banner::where('layout_ads', '=', 'video')->orderBy('created_at', 'desc')->get();
        $data['request_video_vast'] = banner::where('layout_ads', '=', 'vast')->orderBy('created_at', 'desc')->get();

        return view('admin.page.banner.banner', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->Main();
        $data['video_count'] = banner::where('layout_ads', '=', 'video')->count();
        $data['header_title'] = 'เพิ่มโฆษณา';

        return view('admin.page.banner.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (env('DEMO', '0') == '1') {
            return redirect()->back();
        }

        $data = new banner;
        $data->title_ads = $request->title;
        $data->url_ads = $request->url;
        $data->status_ads = $request->status;
        $data->expired = $request->expired;
        $data->position = $request->position;
        $data->show_ads = $request->show_ads;
        $data->type = $request->type;

        // $start = strtotime($request->start);
        // $data->start = date("Y-m-d", $start);

        // $end = strtotime($request->end);
        // $data->end = date("Y-m-d", $end);

        if (env('BANNER_BUTTON', '0') == '1') {
            $button = json_encode($request->button_ads);
            $data->button = $button;
        }

        $data->layout_ads = $request->layout;
        // $data->image_ads = '/images/728.jpg';
        // if($request->layout == "B"){
        //     $data->image_ads = '/images/300.jpg';
        // }
        // ==============================================================
        //
        // ถ้ามีการอัพรูป จะ resize
        //
        // ==============================================================
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();
            $newFilename = Str::random(11).Str::random(20).$filename;
            $newFilename = str_replace(' ', '_', $newFilename);
            // ========================================
            // หากเป็น Product จะไม่ใช้ public_path();
            // ========================================
            $path = 'storage/files/1/';
            if (env('APP_ENV') == 'production') {
                $path = 'storage/files/1/';
                if (! Storage::exists($path)) {
                    Storage::makeDirectory($path);
                }
                $path = 'storage/files/1/';
            } elseif (env('APP_ENV') == 'local') {
                $path = 'storage/files/1/';
                if (! Storage::exists($path)) {
                    Storage::makeDirectory($path);
                }
                $path = 'storage/files/1/';
            }

            $image->move($path, $newFilename);
            // $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            // $image_save->make($image->getRealPath())
            //     ->save($path.$newFilename, 100); // ลด Optimize Image
            $data->image_ads = 'storage/files/1/'.$newFilename;
        }
        $data->save();

        log_post('Create', "สร้างแบนเนอร์ $data->id", Auth::user()->email);

        session()->flash('message', 'เพิ่มโฆษณาหมู่สำเร็จ');

        return redirect()->route('admin.banner');
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
        $data['request'] = banner::find($id);
        $data['video_count'] = banner::where('layout_ads', '=', 'video')->count();
        $data['header_title'] = 'แก้ไขโฆษณา';

        return view('admin.page.banner.edit', $data);
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
        if (env('DEMO', '0') == '1') {
            return redirect()->back();
        }

        $data = banner::find($id);
        $data->title_ads = $request->title;
        $data->url_ads = $request->url;
        $data->layout_ads = $request->layout;
        $data->status_ads = $request->status;
        $data->expired = $request->expired;
        $data->position = $request->position;
        $data->show_ads = $request->show_ads;
        $data->type = $request->type;

        if (env('BANNER_BUTTON', '0') == '1') {
            $button = json_encode($request->button_ads);
            $data->button = $button;
        }

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();
            $newFilename = Str::random(11).Str::random(20).$filename;
            $newFilename = str_replace(' ', '_', $newFilename);
            // ========================================
            // หากเป็น Product จะไม่ใช้ public_path();
            // ========================================
            // $path = 'images/banners/';
            // if (env('APP_ENV') == 'production') {
            //     $path = 'images/banners/';
            // } else if (env('APP_ENV') == 'local') {
            //     $path = public_path('images/banners/');
            // }

            $path = 'storage/files/1/';
            if (env('APP_ENV') == 'production') {
                $path = 'storage/files/1/';
                if (! Storage::exists($path)) {
                    Storage::makeDirectory($path);
                }
                $path = 'storage/files/1/';
            } elseif (env('APP_ENV') == 'local') {
                $path = 'storage/files/1/';
                if (! Storage::exists($path)) {
                    Storage::makeDirectory($path);
                }
                $path = public_path('storage/files/1/');
            }

            $image->move($path, $newFilename);
            // $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            // $image_save->make($image->getRealPath())
            //     ->save($path.$newFilename, 100); // ลด Optimize Image
            $data->image_ads = 'storage/files/1/'.$newFilename;
        }

        $data->update();

        log_post('Update', "อัพเดทแบนเนอร์ $id", Auth::user()->email);

        session()->flash('message', 'แก้ไขหมวดหมู่สำเร็จ');

        return redirect()->route('admin.banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (env('DEMO', '0') == '1') {
            return redirect()->back();
        }

        $data = banner::where('id', $id)->delete();

        log_post('Delete', "ลบแบนเนอร์ $id", Auth::user()->email);

        session()->flash('message', 'ลบเรียบร้อย');

        return redirect()->route('admin.banner');
    }
}
