<?php namespace Jsehersan\Social;
/**
 * Created by PhpStorm.
 * User: JOSE
 * Date: 14/03/2015
 * Time: 16:23
 */

use Channel;
use Jsehersan\Social\Channel\Facebook;
use Jsehersan\Social\Channel\Twitter;

class Helper {

    public static function getChannel ($id){
       
        if ($ty=Channel::find($id)){

	        switch ($ty->type) {
	        	case 'f':
	        		$ch=Facebook::find($id);
	        		if ($ch){
                        $ch->setSession();
	        			return $ch;
	        		}	return false;
	        		
	        		break;
                case 't':
	        		$ch=Twitter::find($id);
	        		if ($ch){
	        			return $ch;
	        		}	return false;

	        		break;
	        	
	        	default:
	        		return false;
	        		break;
	        }
	    }   
	    return false; 
    }
    public static function getParam($params){
    	
    }
    public static function asset($url){
    	return asset('packages/jsehersan/social/'.$url);
    }
    public static function jsonSet($json,$params){

    	//Primero descodificamos
    	$json=json_decode($json,true);
    	foreach ($params as $id => $key){
    		$json[$id]=$key;
    	}return json_encode($json);
    }
    public static function dd($dump,$exit=true){
        echo "<pre>";
        var_dump($dump);
        echo "</pre>";
        if ($exit==true){
            exit();
        }
    }
    public static function sortUrl($longUrl){
         return file_get_contents('http://tinyurl.com/api-create.php?url='.$longUrl);
    }
    public static function getInternalImg($img){
        $url=explode('public_html',$img);
        return $url[1];

    }
} 