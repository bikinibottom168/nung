<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\Setting;
use Intervention\Image\ImageManager;
use GuzzleHttp\Client;
use Auth;

class AdminLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data['log'] = Log::orderBy('updated_at','desc')->paginate(30);

        return view('admin.page.log.log', $data);
    }

}
