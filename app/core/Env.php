<?php
namespace App\Core;

class Env
{
    private static array $keys = [];
    private static array $data = [];

    public static function read(): void
    {
        if (file_exists(DOCROOT . '.env'))
        {
            self::$data = [];

            foreach (explode("\n", file_get_contents(DOCROOT . '.env')) as $row)
            {
                $row = trim($row);
                if ($row == '')
                    continue;
                if (str_starts_with($row, '#'))
                    continue;

                list($key, $value) = explode('=', $row, 2);

                self::$keys[] = $key;

                if ($value == '')
                    continue;
                if (strtolower($value) == 'true')
                    $value = true;
                if (strtolower($value) == 'false')
                    $value = false;
                if (strtolower($value) == 'null')
                    $value = null;

                self::$data[$key] = $value;
            }
        }
    }

    public static function get($key, $default = false)
    {
        if (! self::$data)
            self::read();

        if (array_key_exists($key, $_ENV))
            return $_ENV[$key];

        if (array_key_exists($key, self::$data))
            return self::$data[$key];

        return $default;
    }

    public static function hasKey(string $key): bool
    {
        if (! self::$keys)
            self::read();

        if (array_key_exists($key, $_ENV))
            return true;

        if (in_array($key, self::$keys))
            return true;

        return false;
    }

    function __get($key)
    {
        return self::get($key);
    }
}