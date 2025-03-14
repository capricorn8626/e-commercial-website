<?php
class App{

    protected $controller="Home";
    protected $action="default";
    protected $params=[];



    function __construct(){
        
        $arr = $this->UrlProcess();
        
        // Xu li Controller
        if($arr!=NULL) {
            if (file_exists("./mvc/controllers/".$arr[0].".php")){
                $this->controller = $arr[0];
                unset($arr[0]);
            } else {
    
            }
        }
        require_once "./mvc/controllers/".$this->controller.".php";
        $this->controller = new $this->controller;
        // Xu li Action
        if(isset($arr[1])){
            if(method_exists($this->controller,$arr[1])){
                $this->action = $arr[1];
                unset($arr[1]);
            }
        
        }

        // Xu li Params
        $this->params = $arr?array_values($arr):[];
        // $controllerObj = new $this->controller();
        call_user_func_array([$this->controller, $this->action],$this->params)   ;    
        
    }
    function UrlProcess(){
        if ( isset($_GET["url"]) ) {
           return explode("/", filter_var(trim($_GET["url"],"/")));

        }       
    }
}
?>