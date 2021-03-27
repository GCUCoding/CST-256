<?php

namespace App\Services\Data\Utility;

interface ILogger
{
    static function getLogger();
    public static function debug($message, $data);
    public static function info($message, $data);
    public static function warning($message, $data);
    public static function error($message, $data);
}