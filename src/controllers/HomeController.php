<?php namespace Jsehersan\Social\Controllers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;
use Jsehersan\Social\channel\Facebook;
use Channel;
use Post;
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

         $channels=Channel::allChannels();
         $tmp=array(
           'extends' => Config::get('social::social.tmp.admin','layout.base'),
           'section_main' => Config::get('social::social.tmp.section_main','main')
       );
          $header_title=array(
            'clase'=>'fa fa-share-alt',
            'titulo'=>'Social <small>Canales</small>'
            );
         return View::make('social::listChannels',
             compact(
                 'channels','tmp','header_title'
             ));
     }

    public function getPublications(){

         $post=Post::
             status(Request::get('filter'))
             ->paginate(20)
             ->appends(Request::only(['filter']));

         $tmp=array(
           'extends' => Config::get('social::social.tmp.admin','layout.base'),
           'section_main' => Config::get('social::social.tmp.section_main','main')
       );
          $header_title=array(
            'clase'=>'fa fa-share-alt',
            'titulo'=>'Social <small>Publicaciones</small>'
            );
         return View::make('social::listPublications',
             compact(
                 'post','tmp','header_title'
             ));
    }

     public function getPublication($id){

         $post=Post::findOrFail($id);
         if (!$post){
             return "Post no encontrado";
         }
            
         $tmp=array(
           'extends' => Config::get('social::social.tmp.admin','layout.base'),
           'section_main' => Config::get('social::social.tmp.section_main','main')
       );
          $header_title=array(
            'clase'=>'fa fa-share-alt',
            'titulo'=>'Social <small>Publicacion: '.$post->title.'</small>'
            );
         return View::make('social::publicationDet',
             compact(
                 'post','tmp','header_title'
             ));
    }

}
