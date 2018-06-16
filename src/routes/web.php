<?php

use YazeedObaid\Lang\Facades\ExportLangs;


Route::get(config('laravel-lang.routes.prefix'), function () {

    $strings = ExportLangs::export()->toArray();

    return response()->json($strings);
})->name(config('laravel-lang.routes.name'))
    ->middleware(config('laravel-lang.routes.middleware'));
