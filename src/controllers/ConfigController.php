<?php namespace Jsehersan\Social\Controllers;

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookResponse;
use Facebook\GraphUser;
use Facebook\FacebookCanvasLoginHelper;

use Facebook\FacebookSDKException;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
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
       session_start();
       $ch=Helper::getChannel($id);
       // FACEBOOK
        if ($ch->type=='f'){
            if (!$ch){return "Canal no encontrado";}
            if (Input::get('code')){
                FacebookSession::setDefaultApplication($ch->getParam('APP_ID'),$ch->getParam('APP_SECRET'));
                $helper = new FacebookRedirectLoginHelper(URL::to('social/config/channel/'.$id));
                $session=$helper->getSessionFromRedirect();
                if ($session->validate())
                {
                    $request = new FacebookRequest($session, 'GET', '/me/accounts?fields=access_token');
                    $pageList = $request->execute()
                        ->getGraphObject()->asArray();
                    $ch->setParam('TOKEN',$token=$pageList['data'][0]->access_token);
                }
                return Redirect::to('social/config/channel/'.$id);
            }


            if ($ch->getParam('TOKEN')){
              // $ch->getTokenInfo();
            }
        }
       // !!

       return View::make('social::configChannel',
        compact(
          'ch'
        ));

    }
    public function getTest(){

        if (Input::get('id_channel')){
            $fb=Facebook::find(Input::get('id_channel'));
            Helper::dd($fb->getTokenInfo());
            return Input::get('id_channel');
        }
    }

    public function ajSaveDesChannel(){
      $ch=Channel::find(Input::get('id_ch'));
      $ch->description=Input::get('description');
      if ($ch->save()){
        return Response::json(true);
      } return Response::json(false);
      
    }
    public function ajfb_ValidApp(){
        session_start();
        $id_app=Input::get('id_app');
        $secret_app=Input::get('secret_app');
        $id_ch=Input::get('id_ch');


        try
        {
            FacebookSession::setDefaultApplication($id_app,$secret_app);
            $helper = new FacebookRedirectLoginHelper(URL::to('social/config/channel/'.$id_ch));
            $params = array(
                'scope' => 'manage_pages','publish_stream'
            );
            $url=$helper->getLoginUrl($params);
            $chDB=Facebook::find($id_ch);

            $chDB->setParam('APP_ID',$id_app);
            $chDB->setParam('APP_SECRET',$secret_app);
            return Response::json(array(
                'status'=>true,
                'url' => $url
            ));
        }
        catch(FacebookSDKException $ex)
        {

           return Response::json(array(
               'status'=>false,
               'error' => $ex
           ));
        }






       // return Response::json($helper->getLoginUrl());
    }

    public function delChannel(){

        if (Input::get('id')){
          if(Channel::find(Input::get('id'))->delete()){
             return Redirect::back()->with('message','Canal eliminado correctamente');
          }
        }

    }

}
