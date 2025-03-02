<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/web2/">
    <link rel="stylesheet" href="public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Boba Shop</title>
</head>
<body>
    <header>
        <nav id="navbar">
        <div class="logo" id="logo">
            <span class="dot"></span>
            Boba
            Shop               
            <span class="dot"></span>
        </div>
        <input type="checkbox" id="check">
        <label for="check" class="menu"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
          </svg></label>
          <ul class="nav-links">
            <li><a href="home" >TRANG CHỦ</a></li>
            <li><a href="category" >SẢN PHẨM</a></li>
            <li><a href="#about" >VỀ CHÚNG TÔI</a></li>
            <li><a href="#footer" >LIÊN HỆ</a></li>
          </ul>
    </nav>
    </header>
    <section class="home" id="home">
       
        <div class="intro">
            <div>
                <span>Welcome to</span>
                <h1>MilkTea Shop</h1>
                <h2>24 Hours without Drinking milktea</h1>
                <h2>Can make people weak</h2>
            </div>
            <div>
                <button><a href="./Auth">Tham Gia Ngay<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-index" viewBox="0 0 16 16">
                    <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 1 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 0 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.035a.5.5 0 0 1-.416-.223l-1.433-2.15a1.5 1.5 0 0 1-.243-.666l-.345-3.105a.5.5 0 0 1 .399-.546L5 8.11V9a.5.5 0 0 0 1 0V1.75A.75.75 0 0 1 6.75 1M8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v5.34l-1.2.24a1.5 1.5 0 0 0-1.196 1.636l.345 3.106a2.5 2.5 0 0 0 .405 1.11l1.433 2.15A1.5 1.5 0 0 0 6.035 16h6.385a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5 5 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.6 2.6 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046zm2.094 2.025"/>
                  </svg></a></button>
            </div>
        </div>
        <div class="home-bg">
            <div class="image"><img src="public/img/cup_of_milktea.png" alt="milktea"></div>
        </div>
        <div class="scroll">
            <a href="#slideshow">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                  </svg>
                  <span>
                    Kéo xuống để <br/>Tìm hiểu thêm
                  </span>
            </a>
        </div>
    </section>
    <section class="slideshow" id="slideshow">  
    <div class="slider">
        <div class="list">
            <?php foreach ($data['slides'] as $slide) : ?>
                <div class="item">
                    <img src="<?php echo $slide['img']; ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="buttons">
            <button id="prev"><i class='bx bxs-left-arrow'></i></button>
            <button id="next"><i class='bx bxs-right-arrow'></i></button>
        </div>
        <ul class="dots">
            <?php foreach ($data['slides'] as $index => $slide) : ?>
                <li <?php if ($index === 0) echo "class='active'"; ?>></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
    
    <section class="product" id="product">
        <div class="heading">
            <span>Menu</span>
            <h1>Sản phẩm bán chạy</h1>
            <span class="underline">--------------------<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
              </svg>--------------------</i></span>           
        </div>
        <div class="product-container">
           <?php 
           function convertToVND($number) {
            $number = intval($number);
            $formatted = number_format($number, 0, ',', '.');          
            return  $formatted . " đ";
          }
           $products = $data['products'];
           foreach ($products as $index) {
            $name = $index['name'];
            $image = $index['img'];
            $id = $index['id'];
            $where_price = [
                'size' => 'M',
                'id_mon_an' => $id,
            ];
            $countSale = $index['countSale'];
            $price = ($this->MyModels->select_row('gia_mon_an','price',$where_price));
            echo '<div class="box">';
            echo '<div class="box-img">';
            echo '<img src="' . $image . '" alt="">';
            echo '</div>';
            echo '<h2>' . $name . '</h2>';
            echo '<span>Đã bán '. $countSale.' ly</span>';
            echo '<span>'. convertToVND($price).'</span>';
            echo '<a href="#" class="btn">Đặt Hàng Ngay</a>';
            echo '</div>';
        }
           ?>
        <div class="btn2div">
            <a href="category" class="btn2">Xem Tất Cả</a>
        </div>

    </div>
     
    </section>
        <section class="about" id="about">
        <div class="about-container">
            <div class="about-img">
                <img src="public/img/about.png" alt="">
            </div>
            <div class="about-text">
                <h2>50 years of serving communities</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius quidem unde explicabo, labore distinctio, quasi ab voluptatum molestiae animi totam dignissimos quam fugit laborum expedita pariatur minus necessitatibus tenetur sapiente.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum architecto officia similique porro autem! Eius aut perferendis harum quia rerum corporis, ut nobis nam assumenda ipsa deserunt sequi omnis expedita!</p>
                <a href="#" class="btn">Tìm hiểu thêm</a>
            </div>
        </div>  
    </section>
    <section class="delivery" id="delivery">
        <div class="delivery-container">      
            <div class="delivery-text">
                <h2>Delivery everywhere today</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius quidem unde explicabo, labore distinctio, quasi ab voluptatum molestiae animi totam dignissimos quam fugit laborum expedita pariatur minus necessitatibus tenetur sapiente.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum architecto officia similique porro autem! Eius aut perferendis harum quia rerum corporis, ut nobis nam assumenda ipsa deserunt sequi omnis expedita!</p>
                <a href="#" class="btn">Đặt ngay</a>
            </div>
            <div class="delivery-img">
                <img src="public/img/delivery.png" alt="">
            </div>
        </div>  
    </section>
    <button title="Scroll back to the top" id="scrollBack" class="scroll-back" alt="1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
      </svg></button>

      <footer class="footer" id="footer">
        <div class="social">
        <a href="#"><i class='bx bxl-facebook-circle' ></i></a>
        <a href="#"><i class='bx bxl-instagram'></i></a>
        <a href="#"><i class='bx bxl-twitter'></i></a>
        <a href="#"><i class='bx bxl-github' ></i></a>
        </div>
        <div class="links">
            <a href="#">Policy</a>
            <a href="#">Terms Of Use</a>
            <a href="#">Our Company</a>
        </div>
        <p>&#169; 2024 PhanVietToan All Right Reserved.</p>
    </footer>
    
  <script src="public/js/script.js"></script>
</body>
</html>