<?php

namespace App\Services\Data\Utility;

use Illuminate\Support\Facades\Log;

class MyLogger1 implements ILogger
{
    static function getLogger()
    {
    }

    public static function debug($message, $data=array())
    {
        Log::debug($message . (count($data) != 0 ? ' with data of ' . print_r($data, true) : ""));
    }

    public static function info($message, $data=array())
    {
        Log::info($message . (count($data) != 0 ? ' with data of ' . print_r($data, true) : ""));
    }

    public static function warning($message, $data=array())
    {
        Log::warning($message . (count($data) != 0 ? ' with data of ' . print_r($data, true) : ""));
    }

    public static function error($message, $data=array())
    {
        Log::error($message . (count($data) != 0 ? ' with data of ' . print_r($data, true) : ""));
     }
}