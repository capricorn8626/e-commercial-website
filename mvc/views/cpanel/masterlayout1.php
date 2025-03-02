<?php
    session_start();
    ob_start();
    
    
    
        require_once "./mvc/views/cpanel/include/header.php";



        require_once "./mvc/views/cpanel/include/navbar.php";



        require_once "./mvc/views/cpanel/include/banner.php";



        require_once "./mvc/views/cpanel/include/category.php";



        require_once "./mvc/views/cpanel/".$data['page'].".php";

    
        require_once "./mvc/views/cpanel/include/best-sellers.php";
        

        require_once "./mvc/views/cpanel/include/mobileapp.php";


        require_once "./mvc/views/cpanel/include/footer.php";
?>



    