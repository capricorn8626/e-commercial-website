<?php

class Auth extends Controller{
    public $LoginModels ;


    function __construct()
    {
        $this->LoginModels = $this->model('LoginModels');
    } 
    function default(){
        
        $this->view('login',[]);
    }   
}

?>