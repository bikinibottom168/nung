<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Crypt;

class VideoController extends Controller
{
    public $domain = "http://streaming-premium.com/player";

    public function getStreaming($url)
    {

        $domain_2 = base64_encode(request()->getHost());
        $url = $this->domain."/".$domain_2."/".base64_encode($_SERVER["HTTP_CF_CONNECTING_IP"])."/".Crypt::encryptString($url);
        $client = new Client;
        $res = $client->request('GET', $url, ['http_errors' => false]);
        $getBody = $res->getBody();
        $getBody = urldecode($getBody);
        $response = json_decode($getBody);

        dd($response->streaming);

    }
}
