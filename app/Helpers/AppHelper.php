<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Models\Language;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AppHelper
{

    public static function sysType($selector)
    {
        //Check system : lunix / windows..
        if (DIRECTORY_SEPARATOR == '/') :
            $slash = "/";
            $separator = ';';
        else :
            $slash = "\\";
            $separator = '&&';
        endif;
        $arr = ['separator' => $separator, 'slash' => $slash];
        return $arr[$selector];
    }

    public static function numberGenerator($nb)
    {
        return substr(str_shuffle("0123456789"), 0, $nb);
    }
    public static function alphaGenerator($nb)
    {
        $abc = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ";
        $letters = str_split($abc);
        $str = "";
        for ($i = 0; $i < $nb; $i++) {
            $str .= $letters[rand(0, count($letters) - 1)];
        };
        return $str;
    }

    public static function stringGenerator($nb)
    {
        return Str::random($nb);
    }

    public static function toTranslate($collection)
    {
        return $collection->translate(App::getLocale());
    }

    public static function dateForHumans($input, $attribute, $precision)
    {
        if (is_array($input) || is_object($input)) {
            $diffForHumans = collect($input)->map(function ($arr) use ($attribute, $precision) {
                $arr['time_ago'] = Carbon::parse($arr[$attribute])->longRelativeDiffForHumans(Carbon::now(), 2);
                return $arr;
            });
            return $diffForHumans->all();;
        } else if (is_string($input)) {
            return Carbon::parse($input)->longRelativeDiffForHumans(Carbon::now(), $precision);
        } else {
            return null;
        }
    }

    public static function timeNow()
    {
        $mytime = Carbon::now();
        return $mytime->toDateTimeString();
    }

    public static function validationCheck($validator)
    {
        if ($validator->fails()) {
            die(response()->json(['error' => $validator->errors()])->getContent());
        }
    }
    public static function getClientIp()
    {
        // Function to get the client IP address 
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
