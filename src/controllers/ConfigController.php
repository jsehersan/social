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
use Illuminate\Support\Facades\Config;

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
    public function getNewChannel()
    {
       $tmp=array(
           'extends' => Config::get('social::social.tmp.admin','layout.base'),
           'section_main' => Config::get('social::social.tmp.section_main','main')
       );
        $header_title=array(
            'clase'=>'fa fa-share-alt',
            'titulo'=>'Social <small>Nuevo Canal</small>'
            );
      return View::make('social::newChannel',
          compact(
              'tmp',
              'header_title'
          ));

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
    //App ceta
    // id 517720631710231
    // secret f73600884be8ae97e9b6f57decd94461

    // app test
    // 1498581137039740
   // secret 7ecf76e159157e5a7f594459e4cf3d46

    //bar 238874002988010


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
                    $request = new FacebookRequest($session, 'GET', '/me/accounts?fields=name,access_token,perms');
                    $pageList = $request->execute()
                        ->getGraphObject()->asArray();
                    if ($ch->getParam('PAGE_ID')){
                        //Comprobamos que la pagina que hemos introducido esta entre las que administra el usuario
                        $page=Facebook::checkIdPage($ch->getParam('PAGE_ID'),$pageList['data']);
                        if($page){
                             $ch->setParam('TOKEN',$page->access_token);
                             $ch->setParam('PAGE_NAME',$page->name);
                             return Redirect::to('social/config/channel/'.$id)->with('message','Canal configurado con exito , Página '.$page->name);
                        }


                    }
                        return Redirect::to('social/config/channel/'.$id)->with('error','Debe introducir el id de la pagina con la cuel quiere publicar');

                }

            }


            if ($ch->getParam('TOKEN')){
              // $ch->getTokenInfo();
            }
        }
       // !!
       $tmp=array(
           'extends' => Config::get('social::social.tmp.admin','layout.base'),
           'section_main' => Config::get('social::social.tmp.section_main','main')
       );
       $header_title=array(
            'clase'=>'fa fa-share-alt',
            'titulo'=>'Social <small>Config::'.$ch->description.'</small>'
            );
       return View::make('social::configChannel',
        compact(
          'ch', 'tmp','header_title'
        ));

    }
    public function getTest(){

        if (Input::get('id_channel')){

             $ch=Helper::getChannel(Input::get('id_channel'));
             return $ch->getTest();
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
        $page_id=Input::get('page_id');


        try
        {
            FacebookSession::setDefaultApplication($id_app,$secret_app);
            $helper = new FacebookRedirectLoginHelper(URL::to('social/config/channel/'.$id_ch));
            $params = array(
                'scope' => 'manage_pages','publish_actions','publish_stream','publish_pages'
            );
            $url=$helper->getLoginUrl($params);
            $chDB=Facebook::find($id_ch);

            $chDB->setParam('APP_ID',$id_app);
            $chDB->setParam('APP_SECRET',$secret_app);
            $chDB->setParam('PAGE_ID',$page_id);
            $ch_status=$chDB->validate();
            return Response::json(array(
                'status'=>true,
                'url' => $url,
                'ch_status' => $ch_status
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
    public function  getLimpiaParams (){
         if (Input::get('id_channel')){
             $ch=Channel::find(Input::get('id_channel'));
             $ch->params="";
             if($ch->save()){
                  return Redirect::back()->with('message','Canal limpiado correctamente');
             }
        }
    }

}
