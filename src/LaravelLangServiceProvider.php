<?php

namespace YazeedObaid\Lang;


use Illuminate\Support\ServiceProvider;
use YazeedObaid\Lang\Classes\ExportLangs;

class LaravelLangServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->bind('export-lang', function () {

            return new ExportLangs();
        });

        /**
         * Config
         */
        $this->mergeConfigFrom(
            __DIR__ . '/config/laravel-lang.php', 'laravel-lang'
        );

        $this->publishes([
            __DIR__ . '/config/laravel-lang.php' => config_path('laravel-lang.php'),
        ], 'config');

        /**
         * Routes
         */
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

    }
}
