<?php namespace Jsehersan\Social\Channel;
/**
 * Created by PhpStorm.
 * User: JOSE
 * Date: 14/03/2015
 * Time: 16:23
 */
use Facebook\FacebookClientException;
use Facebook\FacebookPermissionException;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookResponse;
use Facebook\GraphUser;
use Facebook\FacebookCanvasLoginHelper;

use Facebook\Entities\AccessToken;
use Facebook\FacebookSDKException;


 use Channel;
use Jsehersan\Social\ChannelInterface;
use Jsehersan\Social\Helper;

 class Facebook extends Channel{

	public $tmp_config="cfg_facebook";

    public $session=null;



    public function  setSession(){

        if ($this->getParam('TOKEN')){
            FacebookSession::setDefaultApplication($this->getParam('APP_ID'),$this->getParam('APP_SECRET'));
            $this->session=new FacebookSession($this->getParam('TOKEN'));
        }
    }
    public function getTest(){

   //$accessToken = new AccessToken($this->getParam('TOKEN'));
        try {
            // Get info about the token
            // Returns a GraphSessionInfo object
       // FacebookSession::setDefaultApplication($this->getParam('APP_ID'),$this->getParam('APP_SECRET'));
         //$session = new FacebookSession($this->getParam('TOKEN'));
            $page_post = (new FacebookRequest($this->session, 'POST', '/'.$this->getParam('PAGE_ID').'/feed', array(
                'access_token' => $this->getParam('TOKEN'),
                'name' => 'Post de prueba desde laravel',
                'link' => 'http://cetait.com',
                'description' => 'Hola mundo desde laravel',
                'picture' => 'http://alzovuelo.com/front/images/Vuelos_avion_s.jpg',
                'message' => 'Ya queda menos',
            ) ))->execute()->getGraphObject()->asArray();
// return post_id
            print_r( $page_post );
        } catch(FacebookSDKException $e) {
            var_dump($this->getParam('TOKEN'));
            echo 'Error getting access token info: ' . $e->getMessage();
           // var_dump($e);
            exit;
        }

// Dump the info about the token
       // var_dump($accessTokenInfo->asArray());

//        FacebookSession::setDefaultApplication($this->getParam('APP_ID'),$this->getParam('APP_SECRET'));
//        $session = new FacebookSession($this->getParam('TOKEN'));
//        $page_post = (new FacebookRequest( $session, 'POST', '/'. '238874002988010' .'/feed', array(
//            'access_token' => "CAAVS85xXIXwBAHsJuPuTdfNR0IqGsENKPJkwl8ksiFVwF821Qo4GdTfWQZCPEmbgSaYyo3UFp0NNKQZC2eMzMeaXPTE1xbfRkJlcSXMnWFiR9pNkyogIlilb3ZCsCPBEElCZCXsZBZBOe0RbcqzpXcvFcx0ZAd5pE7UQfvQMTMEcCcmZClY3p71ZA",
//            'name' => 'Facebook API: Posting As A Page using Graph API v2.x and PHP SDK 4.0.x',
//            'link' => 'https://www.webniraj.com/2014/08/23/facebook-api-posting-as-a-page-using-graph-api-v2-x-and-php-sdk-4-0-x/',
//            'caption' => 'The Facebook API lets you post to Pages you administrate via the API. This tutorial shows you how to achieve this using the Facebook PHP SDK v4.0.x and Graph API 2.x.',
//            'message' => 'Check out my new blog post!',
//        ) ))->execute()->getGraphObject()->asArray();
//
//// return post_id
//        print_r( $page_post );

//        $request = new FacebookRequest(
//            $session,
//            'GET',
//            '/oauth/access_token?
//    grant_type=fb_exchange_token&
//    client_id={app-id}&
//    client_secret={app-secret}&
//    fb_exchange_token={short-lived-token} '
//        );
//
//        $response = $request->execute();
//        $grahp=$response->getGraphObject();
      //  Helper::dd($grahp);



    }

    public function validate(){

        try {
            FacebookSession::setDefaultApplication($this->getParam('APP_ID'),$this->getParam('APP_SECRET'));
            $session = new FacebookSession($this->getParam('TOKEN'));
            $session->validate();
        }catch (FacebookSDKException $f){
            return false;
        }
            return true;
    }
    public function getToken(){
            $request = new FacebookRequest($this->session, 'GET', '/me/accounts?fields=access_token');
            $pageList = $request->execute()
            ->getGraphObject()->asArray();
            $this->setParam('TOKEN',$token=$pageList['data'][0]->access_token);
    }
    public function test(){

    }
    public static function checkIdPage($idpage,$data){
        foreach ($data as $d){
            if ($d->id==$idpage){
                return $d;
            }
        }return false;

    }
}