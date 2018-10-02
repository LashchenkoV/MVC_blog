<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 25.09.2018
 * Time: 19:16
 */

namespace app\models;


use core\base\Model;

class Post extends Model
{
    public function author(){
        return $this->belongsTo(User::class,"user_id","id");
    }


}