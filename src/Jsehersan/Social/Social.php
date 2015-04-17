<?php

namespace Jsehersan\Social;

//necesario para utilizar vistas
use Illuminate\Support\Facades\View;
use Jsehersan\Social\channel\Facebook;
use Illuminate\Support\Facades\App;


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
    public function Twitter(){
        return App::make('SocialTw');
    }
}

