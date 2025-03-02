<?php
class Home extends Controller {
    public $MyModels;

    public $mon_an = 'mon_an';
    public $gia = 'gia_mon_an';
    public $slide = 'slideshow';

    function __construct()
    {
        $this->MyModels=$this->model("MyModels");
    }
    function default(){  

        $where_mon_an = [
            'isDelete' => 0,
            'type' => 0, 
        ];
        $kq_mon_an = $this->MyModels->select_array($this->mon_an,'id,name,img,countSale',$where_mon_an,'countSale desc',0,6);
        $kq_slide = $this->MyModels->select_array($this->slide,'img','');
        $slides = array();
        $slides = $kq_slide;
        $products = array();
        $products = $kq_mon_an;
        
        
        $this->view("gioithieu",[
            'products'=>$products,
            'slides' =>$slides,
        ]);
    }
    public function index() {
        $where = [
            'type' => 0,
            'password' => '123123'
        ];
        $kq = $this->MyModels->select_array($this->mon_an,'*',$where);
        $this->view('masterlayout1',[
            "page" => 'users/index',
            "array" => $kq
        ]);
    }
    public function add (){
        
    }
}
?>

