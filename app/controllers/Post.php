<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 02.10.2018
 * Time: 21:00
 */

namespace app\controllers;


use app\models\Category;
use core\base\Controller;
use core\base\View;
use core\system\Auth;
use core\system\Url;

class Post extends Controller
{
    public function action_add()
    {


        $v = new View("posts/add");
        $v->auth=Auth::instance()->isAuth();
        $v->user=Auth::instance()->getCurrentUser();
        $v->categories = Category::all();
        $v->setTemplate();
        echo $v->render();
    }

    public function action_add_handle()
    {
        if(!Auth::instance()->isAuth()){
            Url::redirect("/404");
            return;
        }

    }
}