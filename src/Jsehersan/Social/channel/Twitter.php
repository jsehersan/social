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
use Illuminate\Support\Facades\File;


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

          try{
            $img=Helper::getInternalImg($data['picture']);
            $link=Helper::sortUrl($data['link']);
            $uploaded_media = Social::Twitter()->uploadMedia(['media' => File::get(public_path($img))]);
            $res=Social::Twitter()->postTweet(['status' => $data['name'].' '.$link, 'media_ids' => $uploaded_media->media_id_string]);
            return array('status'=>true);
          }catch (\Exception $e){

               return array('status'=>false,'error'=>$e->getMessage());
          }


    }

}