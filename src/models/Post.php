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



}