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
use core\system\Request;
use core\system\route\Route;
use core\system\Router;
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

        try{
            if(!Request::containsPost("name","category","content"))
                throw new \Exception("Заполните все поля");
            if(!Request::containsFile("image")) throw new \Exception("Файл не задан");

            if(!Request::isAccessFileExtension("image",['png','jpeg','gif']))
                throw new \Exception("Формат файла должен быть jpeg, png или gif");

            $name = Request::saveIncomingFileWithRandomName("image","images");
            if($name===false) throw new \Exception("При загрузке файла произошла ошибка");

            $post = new \app\models\Post();
            $post->name = Request::post("name");
            $post->content = Request::post("content");
            $post->category_id = (int)Request::post("category");
            $post->image = $name;

            $user = Auth::instance()->getCurrentUser();
            $post->user_id = $user->id;
            $post->time = time();


            try{
                $post->save();
            }catch (\Exception $e){
                throw new \Exception("ошибка сохранения, попробуйте еще раз");
            }
            Url::redirect("/");

        }catch (\Exception $e){
            $v = new View("auth/error");
            $v->message = "При добавлении поста произошла ошибка";
            $v->details = $e->getMessage();
            $v->url = $_SERVER["HTTP_REFERER"];
            $v->auth=Auth::instance()->isAuth();
            $v->user=Auth::instance()->getCurrentUser();
            $v->categories=Category::all();
            $v->setTemplate();
            echo $v->render();
        }

    }

    public function action_view()
    {
        try {
            $post = \app\models\Post::where('id', (int)Router::instance()->getActiveRoute()->getParam("id"))->first() ;
            if ($post->isEmpty()) throw new \Exception("");
            $post->time = strftime("%H:%M %d.%m.%Y",$post->time);
            $v = new View("posts/show");
            $v->auth=Auth::instance()->isAuth();
            $v->user=Auth::instance()->getCurrentUser();
            $v->categories=Category::all();
            $v->post=$post;
            $v->setTemplate();
            echo  $v->render();
        }catch (\Exception $e){
            Url::redirect("/404");
            return;
        }

    }

    const POST_PER_PAGE=2;
    public function action_category()
    {
        try {
            $cat_id = Router::instance()->getActiveRoute()->getParam("catid");

            $category = Category::where("id",$cat_id)->first();
            if($category->isEmpty()) throw new \Exception("");

            $page = Router::instance()->getActiveRoute()->getParam("page");
            $page = empty($page)?1:$page;
            $posts = $category->posts()->getPage((int)$page,self::POST_PER_PAGE);
            $count = $category->posts()->getPageCount(self::POST_PER_PAGE);

            $v = new View("posts/cat");
            $v->auth=Auth::instance()->isAuth();
            $v->user=Auth::instance()->getCurrentUser();
            $v->categories=Category::all();
            $v->posts=$posts;
            $v->pc = $count;
            $v->page = $page;
            $v->urlbase = Router::instance()->getActiveRoute()->getBasePath()."/".$cat_id;
            $v->setTemplate();
            echo  $v->render();
        }catch (\Exception $e){
            Url::redirect("/404");
            //echo $e->getMessage();
            return;
        }
    }
}