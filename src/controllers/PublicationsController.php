<?php namespace Jsehersan\Social\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\HTML;
use Jsehersan\Social\channel\Facebook;
use Channel;
use Jsehersan\Social\Helper;
class PublicationsController extends BaseController {
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


    public function setPublish($id){
        $post=\Post::findOrFail($id);
        //Conseguimos el canal puesto como principal
        if($post->status==1){
            return Redirect::back()->with('error','Ya ha sido publicado con exito anteriormente');
        }
        $channel=Helper::getChannel(\Option::getItem('channel','main'));
        $data=array(

                'name' => $post->title,
                'link' =>  $post->link,
                'description' => strip_tags(HTML::decode($post->text)),
                'picture' => $post->img,

        );
        $res=$channel->Publish($data);

        if (!$res['status']){
            $post->status=5;
            $post->result_post=$res['error'];
            $post->save();
            return Redirect::back()->with('error',$res['error']);
        }else{
            $post->status=1;
            $post->result_post=$res['status'];
            $post->channel_id=$channel->id;
            $post->save();
            return Redirect::back()->with('message','Publicado con éxito');
        }

       // die($post->result_status);
    }



}
