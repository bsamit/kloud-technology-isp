<?php

use App\Models\GeneralSettings\SiteSetting;
use Carbon\Carbon;

if (!function_exists('siteSettings')) {
    function siteSettings()
    {
        return SiteSetting::first();
    }
}


if (!function_exists('storeDateFormat')) {
    function storeDateFormat($data, $format = 'Y-m-d')
    {
        if($data){
            $data = Carbon::parse($data);
            return $data->format($format);
        }else{
            return NULL;
        }
    }
}

if (!function_exists('gv')) {
    function gv($params, $key, $default = NULL)
    {
        return (isset($params[$key]) && $params[$key]) ? $params[$key] : $default;
    }
}

