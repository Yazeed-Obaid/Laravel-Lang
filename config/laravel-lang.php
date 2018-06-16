<?php

return [

    'routes' => [

        /**
         * Route prefix, example of route http://localhost/js/langs.js
         */
        'prefix' => env('LARAVEL_LANG_PREFIX', '/js/lang.js'),

        /**
         * Route name, defaults to assets.lang
         */
        'name' => env('LARAVEL_LANG_ROUTE_NAME', 'translations'),

        /**
         * Middleware used on lang routes.
         *
         * You can add more middleware with .env directive, example LARAVEL_LANG_MIDDLEWARE=web,auth:api, etc.
         *
         */
        'middleware' => (env('LARAVEL_LANG_MIDDLEWARE')) ?
            explode(',', env('LARAVEL_LANG_MIDDLEWARE'))
            : [],
    ],


    'events' => [

        /**
         * This package emits some events after it getters all translation messages
         *
         * Here you can change channel on which events will broadcast
         */
        'channel' => env('LARAVEL_LANG_EVENTS_CHANNEL', ''),
    ],


    'paths' => [
        /**
         * For each package in your project you can define the relative path to that
         * package from your root app directory to the lang directory in that package
         * to use it in export to Vue. The default path to Laravel applications which
         * is /resources/lang is set by default to you
         * */

        /**
         * Default path is the resources/lang path.
         * */
        'default' => '/resources/lang',

        /**
         * Here you define a path for each package you want to export the
         * translations for.
         * */
    ],


    'files_to_exclude' => [
        /**
         * Some flags to control which files to use in export.
         * */

        /**
         * To disable the default lang directory of a Laravel application set this
         * flag to true. By default it is false to include this directory in export.
         * */

        'default' => [
        ]
    ]
];
