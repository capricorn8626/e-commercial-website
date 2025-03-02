<?php
class Category extends Controller {
    
    public $CategoryModels;
    var $template = 'category';
    public $mon_an = 'mon_an';
    public $gia = 'gia_mon_an';
    public $category = 'category';
    public $Functions;

    function __construct()
    {
        
        $this->CategoryModels = $this->model("CategoryModels");
        $this->Functions = $this->helper("Func");
    }
    
    function default(){  
        $where = [
            'id' => 1,
        ];
        $limit_kq = $this->CategoryModels->select_array('setting','*',$where);
        $limit =  $limit_kq[0]['limit'];
        $where_mon_an = [
            'mon_an.isDelete' => 0,
            'mon_an.type' => 0, 
        ];
        $where_category = [
            'NOT id' => 'CATE000',
        ];
        $where_topping = [
            'isDelete' => 0,
            'type' => 1, 
        ];
        
        $category_labels = $this->CategoryModels->select_array($this->category,'*',$where_category,'id asc');
        $categories = array();
        $categories = $category_labels;
        
        $all_products = $this->CategoryModels->select_array_join_table($this->mon_an,'mon_an.*',$where_mon_an,'mon_an.id asc',NULL,NULL,'category','category.id = mon_an.id_cate','INNER');
        
       
        $products = array();
        $products = $all_products;
        
        
        $page = 1;
        $total_row = count($all_products);
        $total_page = ceil($total_row / $limit);
        $start = ($page - 1) * $limit;
        if ($total_row > 0) {
            $all_products = $this->CategoryModels->select_array_join_table($this->mon_an,'mon_an.*',$where_mon_an,'mon_an.id asc',$start,$limit,'category','category.id = mon_an.id_cate','INNER');
            $products = $all_products;
        }
        $button_pagination = $this->Functions->pagination($total_page,$page);
        $kq_best_sellers = $this->CategoryModels->select_array($this->mon_an,'*',$where_mon_an,'countSale desc',0,10);
        $bestSellers = array();
        $bestSellers = $kq_best_sellers;
        $data = [
            "page" => $this->template.'/index',
            "template" => $this->template,
            'category' => $categories,
            'product' => $products,
            'button_pagination' => $button_pagination,
            'bestSellers' => $bestSellers,
            'limit' => $limit,
            
            
        ];
        $this->view("masterlayout1",$data);
    }
    function pagination_page() {
        if (isset($_POST['limit'])) {
            $limit = $_POST['limit'];
              $sql="UPDATE `setting` SET `limit` = $limit WHERE `id` = 1";
              $this->CategoryModels->query($sql);
        } else {
            $where = [
                'id' => 1,
            ];
            $limit_kq = $this->CategoryModels->select_array('setting','*',$where);
            $limit =  $limit_kq[0]['limit'];
        }
        $data = [
            "template" => $this->template,
            'limit' => $limit,
        ];

        $this->view("category/loadTable",$data);
    }
    
    
}
?>

