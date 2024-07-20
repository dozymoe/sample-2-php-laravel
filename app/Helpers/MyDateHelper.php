<?php

namespace App\Helpers;

use Carbon\Carbon;

class MyDateHelper
{
    public static function format(Carbon $date): string
    {
        return $date->setTimezone(config('app.usertz'))->format('d-m-Y');
    }
}
