<?php

namespace App\Core;

use App\Models\Database;

class Kernel
{
    public static function init(): void
    {
        self::displayErrors();
        self::setTimeZone();
        self::connectToDB();
    }

    /**
     * Включает или отключает отображение ошибок,
     * в зависимости от настроек в .env файле
     */
    protected static function displayErrors(): void
    {
        if (php_sapi_name() == "cli") {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
        } else {
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(0);
        }
    }

    protected static function setTimeZone(?string $timezone = null): void
    {
        $timezone = config('app.timezone');

        if (!empty($timezone)) {
            date_default_timezone_set($timezone);
        }
    }

    public static function connectToDB(): void
    {
        if (config('db.host') && config('db.database') && config('db.username'))
        {
            new Database();
        }
    }
}