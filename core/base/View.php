<?php
/**
 * Created by PhpStorm.
 * User: mamedov
 * Date: 30.08.2018
 * Time: 19:41
 */
namespace core\base;
use app\configuration\MainConfigurator;

class View
{


//echo $twig->render('index.html', array('name' => 'Fabien'));
    private $path;
    private $template_path=null;
    private $loader,$twig;

    private $params =[];

    public function __set($name,$value){
        $this->params[$name]=$value;
    }
    public function __get($name){
        return $this->params[$name];
    }
    public function __construct(string $name){
        $this->path = "views/".$name.".twig";
        $this->loader = new \Twig_Loader_Filesystem(APP_PATH);
        $opt = MainConfigurator::TEMPLATE_CACHE ? ['cache'=>DOCROOT."cache/views"]:[];
        $this->twig = new \Twig_Environment($this->loader,$opt);

    }

    private function _render(){
        return $this->twig->render($this->path,$this->params);
    }
    private function _renderTemplate(){
        $this->params["content"] = $this->_render();
        return $this->twig->render($this->template_path,$this->params);
    }


    public function render(){
        return $this->template_path===null
            ?$this->_render()
            :$this->_renderTemplate();
    }

    public function setTemplate($name = "default"){
        $this->template_path = "templates/".$name.".twig";
    }


}