<section class="py-5 overflow-hidden">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="section-header d-flex flex-wrap justify-content-between mb-5">
              <h2 class="section-title">Danh Mục Sản Phẩm</h2>

              <div class="d-flex align-items-center">
                <a href="#" class="btn-link text-decoration-none">Xem tất cả danh mục →</a>
                <div class="swiper-buttons">
                  <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                  <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <div class="category-carousel swiper">
              <?php $categories = $data['category']; ?>
              <div class="swiper-wrapper">
                <a href="#" data-category-id="all" class="nav-link category-item swiper-slide">
                  <img src="public/img/icon-soft-drinks-bottle.png" alt="Category Thumbnail">
                  <h3 class="category-title">Tất cả</h3>
                </a>
                <?php foreach ($categories as $category) { ?>
                <a href="#" data-category-id="<?php echo $category['id']; ?>" class="nav-link category-item swiper-slide">
                 <img src="public/img/icon-soft-drinks-bottle.png" alt="Category Thumbnail">
                <h3 class="category-title"><?php echo $category['name']; ?></h3>
                </a>
                <?php } ?>
                
                
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <script>
  var catagories;
  document.querySelectorAll('.category-item').forEach(function(item) {
  item.addEventListener('click', function(e) {
    e.preventDefault();
    catagories = $(this).attr('data-category-id');
    $.post('category/pagination_page',{
      catagories:catagories,
      page:1,
    },
      function(data,textStatus,JqXHR) {
        $('#loadTable').html(data);
      }
    )

   
  });
});
</script>