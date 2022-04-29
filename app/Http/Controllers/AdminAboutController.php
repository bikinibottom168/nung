<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\About as about;
use App\Setting;
use App\genre;
use Auth;


class AdminAboutController extends Controller
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

        if (!Schema::hasColumn('abouts', 'rel')) {
            Schema::table('abouts', function($table)
            {
                $table->integer('rel')->default(0);
            });
        }

        $data = $this->Main();
        $data['header_title'] = "จัดการเมนู";
        $data['request'] = about::orderBy('created_at', 'asc')->get();
        return view('admin.page.about.about', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->Main();
        $data['header_title'] = "เพิ่มเมนู";
        $data['category'] = genre::orderBy('id', 'ASC')->get();

        return view('admin.page.about.create', $data);
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

        $data = new about;
        $data->title = $request->title;
        $data->rel = $request->rel;
        $data->type = $request->customRadioInline1; // Radio Type
        if($data->type == "1")
        {
            $data->description = $request->category_select;
        }
        else if($data->type == "2")
        {
            $data->description = $request->url_select;
        }

        log_post("Create","เพิ่มหน้าเพจ $data->title",Auth::user()->email);
        
        $data->save();

        session()->flash('message', "เพิ่มหน้าเพจสำเร็จ");
        return redirect()->route('admin.about');
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
        $data['request'] = about::find($id);
        $data['header_title'] = "แก้ไขเมนู";
        $data['category'] = genre::orderBy('id', 'ASC')->get();

        return view('admin.page.about.edit', $data);
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

        $data = about::find($id);
        $data->title = $request->title;
        $data->rel = $request->rel;
        $data->type = $request->customRadioInline1; // Radio Type
        if($data->type == "1")
        {
            $data->description = $request->category_select;
        }
        else if($data->type == "2")
        {
            $data->description = $request->url_select;
        }
        
        $data->update();

        log_post("Update","อัพเดทหน้าเพจ $data->title",Auth::user()->email);

        session()->flash('message', "แก้ไขหน้าเพจสำเร็จ");
        return redirect()->route('admin.about');
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
        
        $data = about::where('id',$id)->delete();

        log_post("Delete","ลบหน้าเพจ $id",Auth::user()->email);

        session()->flash('message', 'ลบเรียบร้อย');
        return redirect()->route('admin.about');
    }
}
