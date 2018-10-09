<?php

namespace app\controllers;

use app\models\Category;
use app\models\Post;
use app\models\User;
use core\base\Controller;
use core\base\View;
use core\system\Auth;
use core\system\database\Database;
use core\system\database\DatabaseQuery;
use core\system\hasher\PassHasher;
use core\system\Session;

class Main extends Controller
{
    public function action_index()
    {

        $v = new View("main");
        $v->posts = Post::limit(10)->desc("id")->all();
        $v->auth=Auth::instance()->isAuth();
        if($v->auth)
            $v->isAdmin = User::where("id",Session::instance()->getUserId())->first()->hasRole("admin");
        $v->user=Auth::instance()->getCurrentUser();
        $v->categories = Category::all();
        $v->setTemplate();
        echo $v->render();
    }
}