<?php namespace Jsehersan\Social\Channel;
/**
 * Created by PhpStorm.
 * User: JOSE
 * Date: 14/03/2015
 * Time: 16:23
 */
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
 use Jsehersan\Social\Helper;

 class Facebook extends Channel{

	public $tmp_config="cfg_facebook";

    private $session=null;

    public function  setSession(){

//        if ($this->getParam('TOKEN')){
//            $this->session=new FacebookSession($this->getParam('TOKEN'));
//            var_dump($this->session);
//        }
    }
    public function getTokenInfo(){

//        FacebookSession::setDefaultApplication($this->getParam('APP_ID'),$this->getParam('APP_SECRET'));
//        $session = new FacebookSession($this->getParam('TOKEN'));
        $accessToken = new AccessToken($this->getParam('TOKEN'));

        try {
            // Get info about the token
            // Returns a GraphSessionInfo object

        FacebookSession::setDefaultApplication($this->getParam('APP_ID'),$this->getParam('APP_SECRET'));
         $session = new FacebookSession($this->getParam('TOKEN'));
            $accessTokenInfo = $accessToken->getInfo();
            $page_post = (new FacebookRequest( $session, 'POST', '/'.$this->getParam('APP_ID').'/feed', array(
                'access_token' => $this->getParam('TOKEN'),
                'name' => 'Facebook API: Posting As A Page using Graph API v2.x and PHP SDK 4.0.x',
                'link' => 'https://www.webniraj.com/2014/08/23/facebook-api-posting-as-a-page-using-graph-api-v2-x-and-php-sdk-4-0-x/',
                'caption' => 'The Facebook API lets you post to Pages you administrate via the API. This tutorial shows you how to achieve this using the Facebook PHP SDK v4.0.x and Graph API 2.x.',
                'message' => 'Check out my new blog post!',
            ) ))->execute()->getGraphObject()->asArray();

// return post_id
            print_r( $page_post );

        } catch(FacebookSDKException $e) {
            echo 'Error getting access token info: ' . $e->getMessage();
            exit;
        }

// Dump the info about the token
        var_dump($accessTokenInfo->asArray());

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

    public function test(){

    }
}