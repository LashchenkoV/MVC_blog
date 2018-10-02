<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 13.09.2018
 * Time: 19:21
 */

namespace app\controllers;


use core\base\Controller;

class C404 extends Controller
{
    public function action_index(){
        echo "404";
    }
}