<?php

namespace App\Core;

class Config
{
    protected static $storage = [];

    final function __construct()
    {
        return null;
    }

    /**
     * Получить данные из файла конфига
     *
     * @param string $config_path название файла либо путь до элемента в файле
     * @param null $default
     * @return array|mixed|null
     */
    public static function get(string $config_path, $default = null): mixed
    {
        if (array_key_exists($config_path, static::$storage)) {
            return static::$storage[$config_path];
        }

        $path   = static::parseConfigPath($config_path);
        $config = static::getConfigFile($path[0]);

        if (! $path[1]) {
            return $config;
        }

        $i = 0;
        while ($i < count($path[1])) {
            $config = $config[$path[1][$i]];
            $i++;
        }

        if (is_null($config))
            return $default;

        return $config;
    }

    public static function set(string $config, $value): void
    {
        static::$storage[$config] = $value;
    }

    /**
     * Получить директорию конфиг файлов
     *
     * @return string
     */
    protected static function getConfigDir(): string
    {
        return base_path('config/');
    }

    /**
     * Разбивает путь на звание конфига
     * и на путь до элемента конфига
     *
     * @param string $path запрашиваемый путь
     *
     * @return array [0] - название файла; [1] - array путь до элемента
     */
    private static function parseConfigPath(string $path): array
    {
        $result = explode('.', $path, 2);

        if ($result[1] == '')
            $result[1] = null;
        else
            $result[1] = explode('.', $result[1]);

        return $result;
    }

    /**
     * Читает и возращает запрашиваемый файл
     *
     * @param $file
     * @return array|null содержимое файла
     */
    private static function getConfigFile($file): ?array
    {
        if (isset(static::$storage[$file]))
            return static::$storage[$file];

        $dir = static::getConfigDir();

        if (! file_exists($dir . $file . '.php'))
            return null;

        static::$storage[$file] = require $dir . $file . '.php';
        return static::$storage[$file];
    }
}