<?php

namespace Jsehersan\Social;

//necesario para utilizar vistas
use Illuminate\Support\Facades\View;
use Jsehersan\Social\channel\Facebook;

class Social
{

    public function hola($data)
    {

       // Facebook::holaface();
        $datauser=$data;
        return View::make('social::newChannel',compact('datauser'));

    }

    public function vistas()
    {

        return View::make('saludo::hola');

    }
}

