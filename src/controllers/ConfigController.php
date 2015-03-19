<?php namespace Jsehersan\Social\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Channel;

class ConfigController extends BaseController {
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
       return View::make('social::newChannel');

    }

    
     public function postNewChannel() {

        return var_dump(Input::all()); 
     }
    public function  getEmpresa(){

        return $this->layout->content = View::make('front.empresa');

    }
     public function  getMantenimiento(){

        return $this->layout->content = View::make('mantenimiento.index');

    }

}
