<?php

namespace App;

use Illuminate\Translation\FileLoader;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

class Validator
{
    public static function make($request, $rules)
    {
        $languagePath = __DIR__ . '/../resources/lang';
        $languageDefault = 'en';

        $loader = new FileLoader(new Filesystem, $languagePath);
        $translator = new Translator($loader, $languageDefault);
        $validation = new Factory($translator);

        return $validation->make($request->getParams(), $rules);
    }
}