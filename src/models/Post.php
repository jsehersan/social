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
class Post extends Model

{
    protected $table='social_post';

    public function getStatus(){
            switch ($this->status) {
        case 0:
            return "Pendiente";
            break;
        case 1:
            return "Publicado";
            break;
        case 5:
            return "Error en la publicacion";
            break;
            }
        return "Desconocido";
    }

    public function channel(){
        return Helper::getChannel($this->channel_id);
    }

     public function sortUrl(){
        $res = file_get_contents('http://tinyurl.com/api-create.php?url='.$this->link);
        return $res;
    }
    public function findItem($id_item,$type_item,$ch_id){
        $res=self::where('id_item',$id_item)
            ->where('type_item',$type_item)
            ->where('channel_id',$ch_id)
            ->first();
        if ($res){

            return $res;
        }   return false;

    }
    public function scopeStatus($query,$status){
            if ($status!='all'&& trim($status)!=''){
                $query->where('status',$status)->orderBy('updated_at','DESC');
            }

    }
}