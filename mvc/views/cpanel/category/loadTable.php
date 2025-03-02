<?php
$limit=1;
$limit = $data['limit'];

if (isset($_POST['catagories'])&&($_POST['catagories']!=NULL)) {
  $cate_picked = $_POST['catagories'];
  $page = isset($_POST['page']) ? $_POST['page'] : 1;
} else $cate_picked='all';
if ($cate_picked=="all") {
  $where_mon_an = [
    'mon_an.isDelete' => 0,
    'mon_an.type' => 0,            
];
  $products = $this->CategoryModels->select_array_join_table($this->mon_an,'mon_an.*',$where_mon_an,'mon_an.id asc',NULL,NULL,'category','category.id = mon_an.id_cate','INNER');;
  $page = isset($_POST['page']) ? $_POST['page'] : 1;
  $total_row = count($products);
  $total_page = ceil($total_row / $limit);
  $start = ($page - 1) * $limit;
  if ($total_row > 0) {
  $all_products = $this->CategoryModels->select_array_join_table($this->mon_an,'mon_an.*',$where_mon_an,'mon_an.id asc',$start,$limit,'category','category.id = mon_an.id_cate','INNER');
  $products = $all_products;
  }
  $button_pagination = $this->CategoryModels->pagination($total_page,$page);
}
else {
  $where_mon_an = [
    'mon_an.isDelete' => 0,
    'mon_an.type' => 0, 
    'mon_an.id_cate' => $cate_picked,            
];
$products = $this->CategoryModels->select_array_join_table($this->mon_an,'mon_an.*',$where_mon_an,'mon_an.id asc',NULL,NULL,'category','category.id = mon_an.id_cate','INNER');   
$page = $_POST['page']?$_POST['page']:1;
$total_row = count($products);
$total_page = ceil($total_row / $limit);
$start = ($page - 1) * $limit;
if ($total_row > 0) {
  $all_products = $this->CategoryModels->select_array_join_table($this->mon_an,'mon_an.*',$where_mon_an,'mon_an.id asc',$start,$limit,'category','category.id = mon_an.id_cate','INNER');
  $products = $all_products;
}
$button_pagination = $this->CategoryModels->pagination($total_page,$page);
}
?> <?php if (isset($_SESSION['role'])&&($_SESSION['role']==1)) {
    echo '<div class="d-flex align-items-center border p-2">';
    echo '<span class="me-2 fw-bold" id="limitOutput">Limit: <input type="text" id="limitValue" value="'.$limit.'"></span>';
    echo '<button class="btn btn-outline-success btn-sm" id="submitLimit">Submit</button>';
    echo '</div>';
} else {
    echo '<div class="d-flex align-items-center border p-2">';
    echo '<span class="me-2 fw-bold" id="limitOutput">Limit: <input type="text" id="limitValue" value="'.$limit.'"></span>';
    echo '<button class="btn btn-outline-success btn-sm" id="submitLimit">Submit</button>';
    echo '</div>';
}
?>

<div class="col-md-12">

<ul class="pagination" style="justify-content: flex-end;">
        <?= $button_pagination ?>
</ul>
  <div class="bootstrap-tabs product-tabs">
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">

      <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
        <?php 
        function convertToVND($number) {
          $number = intval($number);
          $formatted = number_format($number, 0, ',', '.');          
          return  $formatted . " Vnđ";
        }
        if (!empty($products)) {
          foreach ($products as $product) {
            $name = $product['name'];
            $max_length = 19;
            if (strlen($name)>$max_length) {
                $name = mb_substr($name, 0, $max_length - 5) . '...';
            }
            $img = $product['img'];
            $id = $product['id'];
            $where_price = [
              'size' => 'M',
              'id_mon_an' => $id,
          ];
            $countSale = $product['countSale'];
            $price = ($this->CategoryModels->select_row('gia_mon_an','price',$where_price));
            echo '<div class="col">';
            echo '<div class="product-item">';
            echo '<a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>';
            echo '<figure>';
            echo '<a href="single-product.html" title="Product Title">';
            echo '<img src="' . $img . '" class="tab-image">';
            echo '</a>';
            echo '</figure>';
            echo '<h3>' . $name . '</h3>';
            echo '<span class="qty">Đã bán ' . $countSale . ' Ly</span>';
            echo '<span class="price">' . convertToVND($price) . '</span>';
            echo '<div class="d-flex align-items-center justify-content-between">';
            echo '<a href="#" class="nav-link">Thêm vào giỏ  <svg width="1em" height="1em" viewBox="0 0 24 24"><use xlink:href="#cart"></use></svg></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        }
        ?>

        

      </div>
      <!-- / product-grid -->
      
    </div>
  </div>
</div>


<!-- pagination -->

</div>



    <script>
        $(document).ready(function(){
          let data;
            $('.pagination li a.page-link').click(function(){
                page = $(this).attr('num-page');
                data = {
                  page:page,
                  catagories: '<?php echo $cate_picked; ?>',
                }
                callback('category/pagination_page',data);
            })
            function callback(url,data) {
                $.ajax({
                    url:url,
                    method:"post",
                    data:data,
                    success:function(response) {
                      $('#loadTable').html(response);
                    }
                })
            };
        });
        // slider setLimit 
        
        $(document).ready(function() {
        $("#submitLimit").click(function(){
          let limitValue = $('#limitValue').val();
            $.post('category/pagination_page',{
              limit:limitValue,
              page:'<?php echo $page; ?>',
              catagories: '<?php echo $cate_picked; ?>',
            },
            function(data,textStatus,JqXHR) {
            $('#loadTable').html(data);
            
            }
            )
        })
      });
    </script>