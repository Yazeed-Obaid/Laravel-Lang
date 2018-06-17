# Laravel-Lang
Modular Export of Laravel translations for Front-End and API usage.

This package is inspired from the the way how CMSs built on top of Laravel work and 
how they are structured into packages for large-scale applications. In these CMSs, 
each package has its own langdirectory. 

Also, this package has an exclude array to exclude lang files from each lang directory 
in these modular packages. And finally, an event is emitted after export is done.


## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory 
of your project.

``` bash
$ composer require yazeed-obaid/laravel-lang
```


## Assets Publishing

To publish the config file of the package use:

``` php
php artisan vendor:publish --provider=YazeedObaid\Lang\LaravelLangServiceProvider --tag=config
```


## Usage

Add this route to your Front-End side or call it as an API. http://your-web-app/js/lang.js


## Config File

The config file contains configurations for the route to use for the translations, 
a middlewares array for  the route to be applied to it. An events channel, to specify 
the event channel.

The keys for the 'paths' and 'files_to_exclude' arrays must be the same, since these
keys define each package name (alias). Feel free to select you prefered name.

### Example config file

Below is an example on the path of a package to get its translations with a excluded trans file in 
that package:

``` php
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
        'my-package' => '/packages/myPckage/src/resources/lang'
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
        ],
        'my-package' => [
            'excludedTransFile'
        ]
    ]

```

## A Note to be Mentioned
This package was inspired from [kg-bot/laravel-localization-to-vue](https://github.com/kg-bot/laravel-localization-to-vue).
