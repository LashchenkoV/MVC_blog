<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 02.10.2018
 * Time: 21:08
 */

namespace app\models;


use core\base\Model;

class Category extends Model
{
    public static $table="categories";
    public function posts(){
        return $this->hasMany(Post::class,"category_id");
    }
}