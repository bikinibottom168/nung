<?php
// use App\Option;
// $secret = Option::where('key', 'NOCAPTCHA_SECRET')->first();
// $secret = option_get('NOCAPTCHA_SECRET');
// $sitekey = option_get('NOCAPTCHA_SITEKEY');
// $option_get = config('app.options');
// $secret = $option_get::where('key','NOCAPTCHA_SECRET')->select('value')->first();
// $optiob_get
// $secret = $secret;
return [
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'secret' => env('NOCAPTCHA_SECRET'),
    'options' => [
        'timeout' => 30,
    ],
];
