<?php

// HELPER FOR IAMTHEME.COM
// VERSION 1.0
// AUTHOR IAMTHEME.COM
use App\Log;
use App\Option;

if (! function_exists('option_get')) {
    function option_get($key)
    {
        $data = Option::where('key', $key)->first();
        if ($data) {
            return $data['value'];
        } else {
            return false;
        }
    }
}

if (! function_exists('option_set')) {
    function option_set($key, $value)
    {
        $check = Option::where('key', $key)->first();
        if ($check) {
            $check->delete();
        }

        $data = new Option;
        $data->key = $key;
        $data->value = $value;
        $data->save();

        return $value;
    }
}

if (! function_exists('log_post')) {
    function log_post($type, $message, $user)
    {
        $put_log = new Log;
        $put_log->type = $type;
        $put_log->message = $message;
        $put_log->user = $user;
        $put_log->save();
    }
}
