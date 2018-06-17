<?php

namespace YazeedObaid\Lang;


use Illuminate\Support\ServiceProvider;
use YazeedObaid\Lang\Classes\ExportLangs;

class LaravelLangServiceProvider extends ServiceProvider
{

    public function boot()
    {

        /**
         * Config
         */
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-lang.php', 'laravel-lang'
        );

        $this->publishes([
            __DIR__ . '/../config/laravel-lang.php' => config_path('laravel-lang.php'),
        ], 'config');

        /**
         * Routes
         */
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

    }
}
