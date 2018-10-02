<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 13.09.2018
 * Time: 19:09
 */

namespace app\configuration;


use core\system\exceptions\RouterException;
use core\system\Route;
use core\system\Router;
use core\system\Url;

class RouteConfigurator
{
    public static function routerConfigure(){
        Router::instance()->addRoute(new Route("","main","index"));

        //auth routes
        Router::instance()->addRoute(new Route("register","auth","register"));
        Router::instance()->addRoute(new Route("login","auth","login"));
        Router::instance()->addRoute(new Route("signup","auth","signup"));
        Router::instance()->addRoute(new Route("signin","auth","signin"));
        Router::instance()->addRoute(new Route("logout","auth","logout"));


        //posts
        Router::instance()->addRoute(new Route("posts/add","post","add"));
        Router::instance()->addRoute(new Route("posts/add/handle","post","add_handle"));

        Router::instance()->addRoute(new Route("404","c404","index"));
    }

    public static function onRouterError(RouterException $e){
        //echo $e->getMessage();
        Url::redirect("/404");
    }
}