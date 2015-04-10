<?php

namespace Jsehersan\Social;

//necesario para utilizar vistas
use Illuminate\Support\Facades\View;
use Jsehersan\Social\channel\Facebook;


class Social
{

    public function Channel()
    {
        return new \Channel();
    }

     public function Post()
    {
        return new \Post();
    }
}

