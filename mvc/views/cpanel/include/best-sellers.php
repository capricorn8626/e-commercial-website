<section class="py-5 overflow-hidden">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="section-header d-flex flex-wrap justify-content-between my-5">
              
              <h2 class="section-title">Siêu phẩm cháy hàng</h2>

              <div class="d-flex align-items-center">
                <a href="javascript:void(0)" class="btn-link text-decoration-none">Xem thêm →</a>
                <div class="swiper-buttons">
                  <button class="swiper-prev products-carousel-prev btn button-primary">❮</button>
                  <button class="swiper-next products-carousel-next btn button-primary">❯</button>
                </div>  
              </div>
            </div>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <div class="products-carousel swiper">
              <div class="swiper-wrapper">
                <?php $bestSellers = $data['bestSellers'];
                foreach ($bestSellers as $product) 
                {
                  $name = $product['name'];
                  $max_length = 19;
                  if (strlen($name)>$max_length) {
                     $name = mb_substr($name, 0, $max_length - 7) . '...';
                  }
                  $id = $product['id'];
                  $where_price = [
                    'size' => 'M',
                    'id_mon_an' => $id,
                ];
                
                  $price = ($this->CategoryModels->select_row('gia_mon_an','price',$where_price));
                    echo '<div class="product-item swiper-slide">';
                    echo '<a href="javascript:void(0)" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>';
                    echo '<figure>';
                    echo '<a href="javascript:void(0)" title="Product Title">';
                    echo '<img src="' . $product['img'] . '" class="tab-image">';
                    echo '</a>';
                    echo '</figure>';
                    echo '<h3>' . $name . '</h3>';
                    echo '<span class="qty">Đã bán ' . $product['countSale'] . ' Ly</span>';
                    echo '<span class="price">' . convertToVND($price) . '</span>';
                    echo '<div class="d-flex align-items-center justify-content-between">';
                    echo '<a href="javascript:void(0)" class="nav-link">Thêm vào giỏ  <svg width="1em" height="1em" viewBox="0 0 24 24"><use xlink:href="#cart"></use></svg></a>';
                    echo '</div>';
                    echo '</div>';
                }
?>



              </div>
            </div>
            <!-- / products-carousel -->

          </div>
        </div>
      </div>
    </section>