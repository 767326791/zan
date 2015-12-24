<?php
namespace Zan\Framework\Foundation\Core;

use Zan\Framework\Foundation\Exception\System\InvalidArgument;
use Zan\Framework\Utilities\Types\Dir;

class Config
{
    private static $configPath = '';
    private static $data = [];
    public static function setConfigPath($path)
    {
        if(!$path || !is_dir($path)) {
            throw new InvalidArgument('invalid path for Config ' . $path);
        }
        $path = Dir::formatPath($path);
        self::$configPath = $path;
    }

    public static function get($key)
    {

    }

    public static function clear()
    {
        self::$data = [];
    }

    private static function getConfigFile($key)
    {
        $file = self::$configPath . $key . '.php';
        if(!file_exists($file)) {
            throw new InvalidArgument('No such config file ' . $file);
        }

        $config = require $file;
        self::$data[$key] = $config;

        return $config;
    }
}