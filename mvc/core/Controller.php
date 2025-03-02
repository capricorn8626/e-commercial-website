<?php
class Controller {

    public function model ($model){
        require_once "./mvc/models/".$model.".php";
        return new $model;
    }
    public function view ($view, $data=[]){
        require_once "./mvc/views/cpanel/".$view.".php";
    }
    public function helper($helper){
        require_once "./mvc/helper/".$helper.".php";
        return new $helper;
    }
}
?>