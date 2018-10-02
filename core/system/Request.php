<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 13.09.2018
 * Time: 19:30
 */

namespace core\system;


class Request
{
    private static $body_params=null;

    public static function get($name){
        return @$_GET[$name];
    }
    public static function post($name){
        return @$_POST[$name];
    }
    public static function put($name){
        return self::getBodyParams($name);
    }
    public static function delete($name){
        return self::getBodyParams($name);
    }

    public static function isMethodType(string $type){
        return strtolower($_SERVER["REQUEST_METHOD"])===strtolower($type);
    }

    public static function getBodyParams($name){
        if(self::$body_params!=null) return @self::$body_params[$name];
        $putdata = file_get_contents('php://input');
        $exploded = explode('&', $putdata);
        self::$body_params=[];
        foreach($exploded as $pair) {
            $item = explode('=', $pair);
            if(count($item) == 2)
                self::$body_params[urldecode($item[0])] = urldecode($item[1]);
        }
        return @self::$body_params[$name];
    }


    public static function isGet(){
        return self::isMethodType("GET");
    }
    public static function isPost(){
        return self::isMethodType("POST");
    }
    public static function isPut(){
        return self::isMethodType("PUT");
    }
    public static function isDelete(){
        return self::isMethodType("DELETE");
    }


    public static function containsPost(){
        $args = func_get_args();
        foreach ($args as $a){
            if(empty($_POST[$a])) return false;
        }
        return true;
    }

    public static function containsFile($name){
        return !empty($_FILES[$name]) && $_FILES[$name]["size"]!=0;
    }
    public static function saveIncomingFileAs($name,$savepath){
        $tmp_name = $_FILES[$name]["tmp_name"];
        return move_uploaded_file($tmp_name,DOCROOT."public/files/".$savepath);
    }
    public static function getIncomingFileType($name){
        return $_FILES[$name]["type"];
    }
    public static function isAccessFileExtension($name,array $ext){
        $type = self::getIncomingFileType($name);
        foreach ($ext as $x){
            if(preg_match('/'.$x.'$/i',$type)!=0) return true;
        }
        return false;
    }

    private static function randomName(){
        return strftime("%Y%m%d_%H%M%S_").rand(0,PHP_INT_MAX);
    }
    public static function saveIncomingFileWithRandomName($name,$path){
        $ext = explode("/",self::getIncomingFileType($name))[1];
        $filename = $path."/".self::randomName().".".$ext;
        if(self::saveIncomingFileAs($name,$filename)){
            return "/files/".$filename;
        }else{
            return false;
        }
    }




}