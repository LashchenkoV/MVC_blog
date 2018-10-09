<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 04.10.2018
 * Time: 20:21
 */

namespace core\system\route;


class ParametricalRoute extends Route
{

    private $params = [];
    public function __construct(string $rule, string $controller, string $action)
    {
        parent::__construct($rule, $controller, $action);
    }

    const PARAM_REXP = '/^\{\??([a-z0-9]+)\}$/i';
    const REQIRED_PARAM_REXP = '/^\{[a-z0-9]+\}$/i';


    public function compareRoute()
    {
        $rules = explode("/",$this->getClearRule());
        $paths = explode("/",$this->getClearPath());

        if(count($paths)>count($rules)) return false;
        foreach ($rules as $i=>$rule){
            if(!preg_match(self::PARAM_REXP,$rule,$matches)){
                if($rule!=$paths[$i]) return false;
            } else if(isset($paths[$i])) {
                    $param_name = $matches[1];
                    $this->params[$param_name] = $paths[$i];
            } else if(preg_match(self::REQIRED_PARAM_REXP,$rule)) return false;
        }
        return true;
    }

    public function getParam($name){
        return @$this->params[$name];
    }

    public function getParams(): array
    {
        return $this->params;
    }


    public function getBasePath()
    {
        $rule = $this->getClearRule();
        return "/".trim(preg_replace('/\{\??([a-z0-9]+)\}/i',"",$rule),"/");
    }


}