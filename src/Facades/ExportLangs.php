<?php

namespace YazeedObaid\Lang\Facades;


use Illuminate\Support\Facades\Facade;

class ExportLangs extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \YazeedObaid\Lang\Classes\ExportLangs::class;
    }
}