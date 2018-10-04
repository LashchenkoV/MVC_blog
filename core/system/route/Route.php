<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 30.08.2018
 * Time: 19:45
 */

namespace core\system\route;

class Route
{
    protected $rule;
    protected $controller;
    protected $action;


    public function __construct(string $rule,string $controller,string $action){
        $this->rule = $rule;
        $this->controller = $controller;
        $this->action = $action;
    }


    protected function getClearPath(){
        return trim(Url::getPath(),"/");
    }
    protected function getClearRule(){
        return trim($this->rule,"/");
    }

    public function compareRoute(){
        return $this->getClearRule() === $this->getClearPath();
    }


    public function getController(): string{
        return $this->controller;
    }


    public function getAction(): string{
        return $this->action;
    }


}