<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 07.10.18
 * Time: 16:06
 */

namespace app\models;


use core\base\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class,"user_roles","users_id","roles_id");
    }
}