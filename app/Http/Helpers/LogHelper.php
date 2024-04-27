<?php

namespace App\Http\Helpers;

class LogHelper
{
    public static function Log($message)
    {
        \Illuminate\Support\Facades\Log::info($message);
    }
}