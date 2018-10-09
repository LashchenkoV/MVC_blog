<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 27.09.2018
 * Time: 19:33
 */

namespace core\system\models;


use core\base\Model;
use core\system\hasher\PassHasher;

class User extends Model
{


    public function __set($name, $value)
    {
        if($name==='pass') $value = PassHasher::instance()->hash($value);
        parent::__set($name, $value);
    }


}