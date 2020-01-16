<?php

namespace App\HotRoll\Database;

use Medoo\Medoo;
use App\HotRoll\Bootstrap\Registry;

class Manager
{
    private static $qmsDatabase;
    private static $mesDatabase;
    private static $coilDatabase;

    public static function newDatabase($conf)
    {
        $database = new Medoo([
            'database_type' => $conf['database_type'],
            'database_name' => $conf['database_name'],
            'server' => $conf['server'],
            'username' => $conf['username'],
            'password' => $conf['password'],
        ]);
        return $database;
    }

    public static function buildQmsDatabase()
    {
        $conf = Registry::getConfig("database")["qms"];

        return static::newDatabase($conf);
    }

    public static function buildMesDatabase()
    {
        $conf = Registry::getConfig("database")["mes"];

        return static::newDatabase($conf);
    }

    public static function buildCoilDatabase()
    {
        $database = [];
        foreach (Registry::getConstant("MILLLINES") as $line) {
            $conf = Registry::getConfig("database")["coil"][$line];
            $database[$line] = static::newDatabase($conf);
        }
        return $database;
    }

    public static function getQmsInstance()
    {
        if (null === static::$qmsDatabase) {
            static::$qmsDatabase = static::buildQmsDatabase();
        }
        return static::$qmsDatabase;

    }

    public static function getMesInstance()
    {
        if (null === static::$mesDatabase) {
            static::$mesDatabase = static::buildMesDatabase();
        }
        return static::$mesDatabase;

    }

    public static function getCoilInstance()
    {
        if (null === static::$coilDatabase) {
            static::$coilDatabase = static::buildCoilDatabase();
        }
        return static::$coilDatabase;
    }

    public static function getDatabase($databaseType, $line = '')
    {
        if ($databaseType == "qms") {
            return self::getQmsInstance();
        } else if ($databaseType == "mes") {
            return self::getMesInstance();
        } else if ($databaseType == "coil") {
            return self::getCoilInstance()[$line];
        } else {
            throw new \Exception("Wrong Database Type neither `qms` or `coil` ");
        }
    }

    /**
     * 不允许从外部调用以防止创建多个实例
     * 要使用单例，必须通过 Singleton::getInstance() 方法获取实例
     */
    private function __construct()
    {
    }

    /**
     * 防止实例被克隆（这会创建实例的副本）
     */
    private function __clone()
    {
    }

    /**
     * 防止反序列化（这将创建它的副本）
     */
    private function __wakeup()
    {
    }
}
