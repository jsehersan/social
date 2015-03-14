<?php namespace Jsehersan\Social\Controllers;

use Helpers;
use Channel;

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */


   // protected $layout = 'test';
    public function getIndex()
    {
       Helpers::pre_var(Channel::all());

    }


     public function getDonde() {

        return $this->layout->content = View::make('front.donde');
     }
    public function  getEmpresa(){

        return $this->layout->content = View::make('front.empresa');

    }
     public function  getMantenimiento(){

        return $this->layout->content = View::make('mantenimiento.index');

    }

}
