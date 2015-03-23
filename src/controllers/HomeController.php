<?php namespace Jsehersan\Social\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;
use Jsehersan\Social\channel\Facebook;
use Channel;
use Jsehersan\Social\Helper;
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
       //var_dump(Channel::all());
       foreach (Channel::all() as $c ) {
         # code...
          var_dump($c->description);
            
       }

    }

    
     public function getChannels() {

         $channels=Channel::all();
         return View::make('social::listChannels',
             compact(
                 'channels'
             ));
     }
    public function  getEmpresa(){

        return $this->layout->content = View::make('front.empresa');

    }
     public function  getMantenimiento(){

        return $this->layout->content = View::make('mantenimiento.index');

    }

}
