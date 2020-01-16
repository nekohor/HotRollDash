<?php

namespace App\HotRoll\Bootstrap;

use Yosymfony\Toml\Toml;

class Registry
{
    private static $configs;

    public static function buildConfigs()
    {
        $workDir = getcwd();
        $configDir = $workDir . "/" . "config" . "/";

        $configDir = "D:/client/HotRollDash/public/config/";

        $conf = [];

        // database
        $conf["database"] = Toml::ParseFile($configDir . "database.toml");

        // factorNames
        $conf["factors"] = [];
        $conf["factors"]["qms"] = Toml::ParseFile($configDir . "factors_qms.toml");
        $conf["factors"]["internal"] = Toml::ParseFile($configDir . "factors_internal.toml");

        // constants
        $conf["constants"] = Toml::ParseFile($configDir . "constants.toml");


        return $conf;
    }

    public static function getConfigInstance()
    {
        if (null === static::$configs) {
            static::$configs = static::buildConfigs();
        }
        return static::$configs;
    }

    public static function getConfig($key)
    {
        return static::getConfigInstance()[$key];
    }

    public static function getConstant($key)
    {
        return static::getConfigInstance()["constants"][$key];
    }
    /**
     * 不允许从外部调用以防止创建多个实例
     * 要使用单例，必须通过 Singleton::getInstance() 方法获取实例
     */
    private function __construct()
    {}

    /**
     * 防止实例被克隆（这会创建实例的副本）
     */
    private function __clone()
    {}

    /**
     * 防止反序列化（这将创建它的副本）
     */
    private function __wakeup()
    {}
}
