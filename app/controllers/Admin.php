<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 09.10.18
 * Time: 19:41
 */

namespace app\controllers;


use app\models\User;
use core\base\Controller;
use core\system\Session;
use core\system\Url;

class Admin extends Controller
{
    public function action_index()
    {
        if(!$this->isAdmin()){
            Url::redirect("/login");
            return;
        }
        echo "admin";
    }

    private function isAdmin():bool {
        $id = Session::instance()->getUserId();
        if($id===null) return false;
        return User::where("id",$id)->first()->hasRole("admin");
    }
}