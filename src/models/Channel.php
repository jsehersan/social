<?php
/**
 * Created by PhpStorm.
 * User: JOSE
 * Date: 14/03/2015
 * Time: 23:14
 */

use Illuminate\Database\Eloquent\Model;
use Jsehersan\Social\Helper;
use Jsehersan\Social;
class Channel extends Model

{
    protected $table='social_channel';

    public function setParam($nombre,$valor){


        try {
            $pr = $this->params;
            $this->params = Helper::jsonSet($pr, array($nombre => $valor));
            $this->save();
            return true;
        }catch (ModelNotFoundException $e){
            return "Error al cambiar los parametros del canal";
        }
    }

    public function getParam($nombre){
        $pr=json_decode($this->params,true);
        if (isset($pr[$nombre])){
            return $pr[$nombre];
        }   return false;
    }
    public static function allChannels(){
        $ch=self::all();
        $all=array();
        foreach ($ch as $c){
            $fch=Helper::getChannel($c->id);
            if($fch){
                $all[]=$fch;
            }
        }
        return $all;
    }


}