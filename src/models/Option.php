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
class Option extends Model

    {
        protected $table='social_config';


        public static function getItem($tipo,$nombre){
        $caracteristica=self::where('tipo','=',$tipo)->where('nombre','=',$nombre)->first();
        return $caracteristica->valor;
    }
     public static  function saveItem(){
        $inputs=Input::except('_token');
        $campos=0;
        foreach ($inputs as $id => $val){

            $opc=self::find($id);
            $opc->valor=$val;
            if($opc->save()){
                $campos++;
            }

        }
        return $campos;
    }

    }