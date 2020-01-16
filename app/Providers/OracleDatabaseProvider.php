<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Medoo\Medoo;

class OracleDatabaseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHelper();
    }

    protected function registerHelper()
    {
        $this->app->singleton('qmsdb', function ($app) {

            $dbConnection = "database.connections.qms.";
            
            $driver = config($dbConnection . "driver");

            $options = [
                    'database_type' => $driver,
                    'database_name' => config($dbConnection . "database"),
                    'server' => config($dbConnection . "host"),
                    'username' => config($dbConnection . "username"),
                    'password' => config($dbConnection . "password"),
                    'options'  => [\PDO::ATTR_EMULATE_PREPARES => true]
                    // 'charset' => config($dbConnection . "charset"),
            ];


            $prefix = config($dbConnection . "prefix");

            if (!empty($prefix)) {
                $options['prefix'] = $prefix;
            }

            return new Medoo($options);
        });

        $this->app->singleton('mesdb', function ($app) {

            $dbConnection = "database.connections.mes.";
            
            $driver = config($dbConnection . "driver");

            $options = [
                    'database_type' => $driver,
                    'database_name' => config($dbConnection . "database"),
                    'server' => config($dbConnection . "host"),
                    'username' => config($dbConnection . "username"),
                    'password' => config($dbConnection . "password"),
                    'options'  => [\PDO::ATTR_EMULATE_PREPARES => true]
                    // 'charset' => config($dbConnection . "charset"),
            ];


            $prefix = config($dbConnection . "prefix");

            if (!empty($prefix)) {
                $options['prefix'] = $prefix;
            }

            return new Medoo($options);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
