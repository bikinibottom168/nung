<?php

namespace App\Http\Controllers;

use App\Article;
use App\genre;
use App\Setting;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class AdminArticleController extends Controller
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
        $data['header_title'] = '';
        $data['request'] = Article::orderBy('updated_at', 'asc')->get();

        return view('admin.page.article.article', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->Main();
        $data['header_title'] = 'เพิ่มข่าวสาร';

        return view('admin.page.article.create', $data);
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

        $data = new Article;
        $data->title = $request->title;
        $data->description = $request->description;

        $title = explode(' ', $request->title);
        $title = implode('-', $title);
        $title = explode('(', $title);
        $title = implode('', $title);
        $title = explode(')', $title);
        $title = implode('', $title);
        $title = explode('.', $title);
        $title = implode('', $title);
        $title = explode('?', $title);
        $title = implode('', $title);
        $title = explode(':', $title);
        $title = implode('', $title);
        $title = explode('|', $title);
        $title = implode('', $title);
        $title = explode(';', $title);
        $title = implode('', $title);
        $title = explode('*', $title);
        $title = implode('', $title);
        $title = explode('+', $title);
        $title = implode('', $title);
        $title = explode('/', $title);
        $title = implode('', $title);
        $title = explode('!', $title);
        $title = implode('', $title);
        $title = explode('@', $title);
        $title = implode('', $title);
        $title = explode('$', $title);
        $title = implode('', $title);
        $title = explode('#', $title);
        $title = implode('', $title);
        $title = explode('&', $title);
        $title = implode('', $title);

        $data->slug_title = $title;

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();
            $newFilename = str_random(11).str_random(20).$filename;
            $newFilename = str_replace(' ', '_', $newFilename);
            // ========================================
            // หากเป็น Product จะไม่ใช้ public_path();
            // ========================================
            $path = 'images/';
            if (env('APP_ENV') == 'production') {
                $path = 'images/';
            } elseif (env('APP_ENV') == 'local') {
                $path = public_path('images/');
            }

            $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            $image_save->make($image->getRealPath())
                ->resize(350, 350)
                ->save($path.$newFilename, 90); // ลด Optimize Image
            $data->image = 'images/'.$newFilename;
        }

        $data->save();

        log_post('Create', "เพิ่มบทความ $data->title", Auth::user()->email);

        session()->flash('message', 'เพิ่มข่าวสารสำเร็จ');

        return redirect()->route('admin.article');
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
        $data['request'] = Article::find($id);
        $data['header_title'] = 'แก้ไขข่าวสาร';

        return view('admin.page.article.edit', $data);
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

        $data = Article::find($id);
        $data->title = $request->title;
        $data->description = $request->description;

        $title = explode(' ', $request->title);
        $title = implode('-', $title);
        $title = explode('(', $title);
        $title = implode('', $title);
        $title = explode(')', $title);
        $title = implode('', $title);
        $title = explode('.', $title);
        $title = implode('', $title);
        $title = explode('?', $title);
        $title = implode('', $title);
        $title = explode(':', $title);
        $title = implode('', $title);
        $title = explode('|', $title);
        $title = implode('', $title);
        $title = explode(';', $title);
        $title = implode('', $title);
        $title = explode('*', $title);
        $title = implode('', $title);
        $title = explode('+', $title);
        $title = implode('', $title);
        $title = explode('/', $title);
        $title = implode('', $title);
        $title = explode('!', $title);
        $title = implode('', $title);
        $title = explode('@', $title);
        $title = implode('', $title);
        $title = explode('$', $title);
        $title = implode('', $title);
        $title = explode('#', $title);
        $title = implode('', $title);
        $title = explode('&', $title);
        $title = implode('', $title);

        $data->slug_title = $title;

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $filename = $image->getClientOriginalName();
            $newFilename = str_random(11).str_random(20).$filename;
            $newFilename = str_replace(' ', '_', $newFilename);
            // ========================================
            // หากเป็น Product จะไม่ใช้ public_path();
            // ========================================
            $path = 'images/';
            if (env('APP_ENV') == 'production') {
                $path = 'images/';
            } elseif (env('APP_ENV') == 'local') {
                $path = public_path('images/');
            }

            $image_save = new ImageManager; // เรียกใช้ object เพราะไม่สามารถเรียกแบบ static ได้
            $image_save->make($image->getRealPath())
                ->resize(350, 350)
                ->save($path.$newFilename, 90); // ลด Optimize Image
            $data->image = 'images/'.$newFilename;
        }

        $data->update();

        log_post('Update', "อัพเดทบทความ $data->title", Auth::user()->email);

        session()->flash('message', 'แก้ไขข่าสารสำเร็จ');

        return redirect()->route('admin.article');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Article::where('id', $id)->delete();

        log_post('Delete', "บทบทความ $id", Auth::user()->email);

        session()->flash('message', 'ลบเรียบร้อย');

        return redirect()->route('admin.article');
    }
}
