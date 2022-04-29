<?php

namespace App\Http\Controllers\Auth;

use App\Collection;
use App\genre;
use App\Http\Controllers\Controller;
use App\Indexsetting;
use App\Menu as menu;
use App\Request as req;
use App\Setting;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/movie';

    protected $maxAttempts = 5;

    protected $decayMinutes = 2;

    // protected $redirectToApplication = '/application';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function Main()
    {
        $data['setting'] = Setting::find(1);
        $data['category'] = genre::orderBy('id', 'asc')->get();
        $data['mode'] = 'home';

        return $data;
    }
}
