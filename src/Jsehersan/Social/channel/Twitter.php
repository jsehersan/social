<?php namespace Jsehersan\Social\Channel;
/**
 * Created by PhpStorm.
 * User: JOSE
 * Date: 14/03/2015
 * Time: 16:23
 */



use Channel;
use Jsehersan\Social\ChannelInterface;
use Jsehersan\Social\Helper;
use Jsehersan\Social\Facades\Social;


 class Twitter extends Channel{

	public $tmp_config="cfg_twitter";

    public $session=null;



    public function validate(){
        try{
               Social::Twitter()->getUserTimeline(['screen_name' => 'thujohn', 'count' => 1, 'format' => 'json']);
               return true;
        }catch (\Exception $e){
                //Helper::dd($e->getMessage());
               return false;
        }
    }

    public function publish($data){

//          try{
//
//           // $res = file_get_contents('http://tinyurl.com/api-create.php?url=http://stackoverflow.com/questions/22355828/doing-http-requests-from-laravel-to-an-external-api');
//            //$uploaded_media = Social::Twitter()->uploadMedia(['media' => File::get(public_path('front/images/vilca_logo4.png'))]);
//            //$res=Social::Twitter()->postTweet(['status' => ' defg  ,jh efg  ,jh  defg  ,jh  defg   defg  ,jh  defg  ,jh  defg  ,j fin '.$res, 'media_ids' => $uploaded_media->media_id_string]);;
//          //  var_dump( Social::Twitter()->getUserTimeline(['screen_name' => 'thujohn', 'count' => 1, 'format' => 'json'])
//          );
//          }catch (\Exception $e){
//
//              return Redirect::back()->with('error',$e->getMessage());
//          }

       // $cfg_tw=Config::get('social.twitter');

    }
}