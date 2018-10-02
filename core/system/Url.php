<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 13.09.2018
 * Time: 19:23
 */

namespace core\system;


class Url
{
    public static function redirect($path){
        header("Location:".$path);
    }

    public static function get(){
        return $_SERVER["REQUEST_URI"];
    }
    public static function getPath(){
        return explode("?",self::get())[0];
    }
    public static function getQuery(){
        return explode("?",self::get())[1];
    }
}