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

        if(Input::get('description')){
          $ch=new Channel();
          $ch->description=Input::get('description');
          $ch->type=Input::get('type-channel');
          if ($ch->save()){
            // return Redirect::
            //action('Jsehersan\Social\Controllers\ConfigController@getConfigChannel', array($ch->id))->with('message','Canal creado');
            return Redirect::route('configChannel',array($ch->id));

          }

        }

     }


    public function  getConfigChannel($id){
       
      $params='{
                "key" : "12344",
                "access_token" : "12344"
              }';

      $new=Helper::jsonSet(Channel::find(12)->params,
      array('access_token' =>'dfghrthjfhbfdgrtdh'
        ));          
      $c12=Channel::find(12);
      $c12->params=$new;
      $c12->save();
      $arr=json_decode($new);

      var_dump($arr);

      exit();

       $ch=Helper::getChannel($id);
       if (!$ch){return "Canal no encontrado";}
       

       return View::make('social::configChannel',
        compact(
          'ch'
        ));

    }
    public function ajSaveDesChannel(){
      $ch=Channel::find(Input::get('id_ch'));
      $ch->description=Input::get('description');
      if ($ch->save()){
        return Response::json(true);
      } return Response::json(false);
      
    } 

}
