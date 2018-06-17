<?php

namespace YazeedObaid\Lang\Facades;


use Illuminate\Support\Facades\Facade;

class ExportLangs extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'export-langs';
    }
}