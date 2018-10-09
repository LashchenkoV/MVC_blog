<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 20.09.2018
 * Time: 20:34
 */

namespace app\models;


use core\base\Model;

class User extends \core\system\models\User
{
    //public static $table="ggg";
    public function posts(){
        return $this->hasMany(Post::class,"user_id","id");
    }
    public function hasRole(string $role):bool{
        return !$this->roles()->andWhere(Role::getTableName().".name","?")->first([$role])->isEmpty();
    }
    public function roles(){
        return $this->belongsToMany(Role::class,"user_roles","users_id","roles_id");
    }
}