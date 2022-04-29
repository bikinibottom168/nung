<?php

namespace App\Http\Controllers;

use App\Seo;
use Illuminate\Http\Request;
use Response;

class AjaxController extends Controller
{
    private $request = '';

    private $type_ajax = [
        //SEO
        'general',
        'webmaster',
        'sitemap',
        'robots',
        'redirect',
        'social_network',
        //Security
        'recaptcha',
        'onpage',
        'read',
        'css_custom',
        'general_color',
        'banner_setting',
        'article_setting',
    ];

    public function __construct()
    {
        $this->middleware('ajax');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if (! $req->type) {
            return abort(403);
        } else {
            $this->request = $req;
            $this->sender($req, $req->type);
        }
    }

    public function sender($req, $type)
    {
        // Check Method Exist
        $check_type = in_array($type, $this->type_ajax);
        if (! $check_type) {
            return abort(403);
        }

        // Call Dynamic Function
        $this->$type($req);
        // call_user_func_array(array($this, array($req,$type)), true);
    }

    // SEO
    public function general(Request $request, $status = true)
    {
        $data = Seo::first();
        $data->seo_title = $request->seo_title;
        $data->seo_description_type = $request->seo_description;
        $data->front_seo = trim($request->front_seo);
        $data->update();

        return Response::json(['status' => 'success'], 200);
    }

    public function webmaster($status = true)
    {
        option_set('google_analytics', $this->request->google_analytics);
        option_set('google_search', $this->request->google_search);

        return Response::json(['status' => 'success'], 200);
    }

    public function onpage($status = true)
    {
        option_set('onpage_header', $this->request->onpage_header);

        return Response::json(['status' => 'success'], 200);
    }

    public function banner_setting($status = true)
    {
        option_set('banner_setting', $this->request->banner_setting);

        return Response::json(['status' => 'success'], 200);
    }

    public function article_setting($status = true)
    {
        option_set('article_home', $this->request->article_home);
        option_set('article_nav', $this->request->article_nav);

        return Response::json(['status' => 'success'], 200);
    }

    public function css_custom($status = true)
    {
        option_set('css_custom', $this->request->css_custom);

        return Response::json(['status' => 'success'], 200);
    }

    public function robots($status = true)
    {
        dd('TEST');
    }

    public function redirect($status = true)
    {
        dd('TEST');
    }

    public function general_color($status = true)
    {
        option_set('primary_color', $this->request->primary_color);
        option_set('navbar_color', $this->request->navbar_color);
        option_set('bg_color', $this->request->bg_color);
        option_set('content_bg_color', $this->request->content_bg_color);
        option_set('badge_color', $this->request->badge_color);
        option_set('footer_color', $this->request->footer_color);

        return Response::json(['status' => 'success'], 200);
    }

    public function social_network($status = true)
    {
        option_set('social_fb', $this->request->social_fb);
        option_set('social_ig', $this->request->social_ig);
        option_set('social_tw', $this->request->social_tw);
        option_set('social_yt', $this->request->social_yt);

        return Response::json(['status' => 'success'], 200);
    }

    public function read($status = true)
    {
        option_set('movie_type', $this->request->movie_type);
        // option_set("category_type", $this->request->category_type);
        option_set('article_type', $this->request->article_type);

        return Response::json(['status' => 'success'], 200);
    }

    // Security

    public function recaptcha($status = true)
    {
        option_set('recaptcha.sitekey', $this->request->sitekey);
        option_set('recaptcha.secret', $this->request->secret);
        option_set('recaptcha.status', $this->request->status);

        return Response::json(['status' => 'success'], 200);
    }
}
