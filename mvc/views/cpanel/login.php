<?php
    session_start();
    ob_start();
    $error = [];
    $err = "";
    if (isset($_POST['action'])) {
        if ($_POST['action']=="dangky") {
            $error = register($this->LoginModels,$error);
        }
        else
        if ($_POST['action']=="dangnhap"){
           $err =  login($this->LoginModels,$err);
        }
    }
    function register($object,$error) 
    {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $rpass = $_POST['rpass'];
        $patternPhone = '/^(?:\+84|0)(?:\d{9}|\d{10})$/';
        $checkPhone = "SELECT COUNT(*) AS count FROM khach_hang WHERE phone = '$phone'";
        $result = $object->query($checkPhone);
        $countPhone = $result[0]['count'];
        $checkUsername = "SELECT COUNT(*) AS count FROM tai_khoan_kh WHERE username = '$user'";
        $kq = $object->query($checkUsername);
        $countUsername = $kq[0]['count'];
        if (empty($name)) {
            $error['name'] = "Bạn chưa nhập tên";
        }
        if (empty($user)) {
            $error['user'] = "Bạn chưa nhập tên đăng nhập";
        }
        if ($countUsername !=0) {
            $error['user'] = "Tên đăng nhập đã được sử dụng";
        }
        if (empty($pass)) {
            $error['pass'] = "Bạn chưa nhập mật khẩu";
        }
        if (empty($phone)) {
            $error['phone'] = "Bạn chưa nhập số điện thoại";
        }
        if ($countPhone != 0) {
            $error['phone'] = "Số điện thoại đã được sử dụng";
        }
        if (!preg_match($patternPhone,$phone)) {
            $error['phone'] = "Số điện thoại không hợp lệ";
        }
        if ($pass != $rpass) {
            $error['rpass'] = "Mật khẩu xác nhận không trùng khớp";
        }
        if ($rpass == '') {
            $error['rpass'] = "Bạn chưa nhập mật khẩu xác nhận";
        }
        
        $_SESSION['error'] = $error;
        if (empty($error)) 
        {   $id = $object->createID('khach_hang');
            $sql_kh = "INSERT INTO khach_hang(id,name,phone) VALUES ('$id','$name','$phone')";
            $qr_kh = $object->conn->prepare($sql_kh);
            $qr_kh ->execute();
            $sql_tk = "INSERT INTO tai_khoan_kh(username,password,type,id_type,isDelete) VALUES ('$user','$pass',0,'$id',0)";
            $qr_tk = $object->conn->prepare($sql_tk);
            $qr_tk ->execute(); 
            echo "success";die;
        }
        return $error;
    }
    function login ($object,$err) 
    {
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $kq = $object->getuserinfo($user,$pass);
        if ($kq) {
            $role = $kq[0]['type'];
        }
        else $role = 2; 
        // role = 2 -> sai tk/mk
        
        if ($role == 1) {
            $_SESSION['role'] = $role;
            $_SESSION['id'] = $kq[0]['id_type'];
            $_SESSION['username']= $kq[0]['username'];
            // dẫn tới trang admin nha
            echo 'admin' ;die;
        }
        else if ($role == 0){
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart']=[];
            }
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $user;
            $_SESSION['id'] = $kq[0]['id_type'];
            echo 'user';die;
            
        }
        else {
            $err = "*Tên đăng nhập hoặc mật khẩu không chính xác";
        }
        return $err;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <base href="http://localhost/web2/">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/login.css">  
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .has-error{
            color: red;
            
        }
    </style>
    <title>Login Form</title>
</head>
<body class="main">

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="">
                <h1>Đăng ký</h1>

                <?php
                if (empty($error)) {
                    ?>
                <div class="social-icons">
                    <a href="javascript:void(0)"><i class='bx bxl-google-plus' ></i></a>
                    <a href="javascript:void(0)"><i class='bx bxl-facebook' ></i></a>
                    <a href="javascript:void(0)"><i class='bx bxl-github' ></i></a>
                    <a href="javascript:void(0)"><i class='bx bxl-linkedin' ></i></a>
                </div>
                <span>hoặc đăng ký bằng thông tin của bạn</span>

                <?php }
                
                ?>
                <input type="hidden" id="action-dangky" value="dangky">
                <input type="text" class="name" id="name-dangky" name="name" maxlength="50" placeholder="Tên">               
                <span class="has-error"><?php echo (isset($error['name']))?$error['name']:''; ?></span>
                <input type="text" class="phone" id="phone-dangky" name="phone" maxlength="15" placeholder="Số điện thoại">
                <span class="has-error"><?php echo (isset($error['phone']))?$error['phone']:''; ?></span>
                <input type="text"  name="username" id="username-dangky" maxlength="30" placeholder="Tên đăng nhập">
                <span class="has-error"><?php echo (isset($error['user']))?$error['user']:''; ?></span>
                <input type="password" name="password" id="password-dangky" maxlength="20" placeholder="Mật khẩu">
                <span class="has-error"><?php echo (isset($error['pass']))?$error['pass']:''; ?></span>
                <input type="password" class="rePassword" id="rpass-dangky" name="repassword" maxlength="20" placeholder="Nhập lại mật khẩu">
                <span class="has-error"><?php echo (isset($error['rpass']))?$error['rpass']:''; ?></span>
                <button type="button" onclick="submitDataDK();" id="dangky" name="dangky" value="Đăng Ký">Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in">
            
            <form method="POST" action="">
                <?php
                if (isset($success)&&$success!="") {
                    echo "<span style = 'color: green'>".$success."</span>";
                    
                }
                else if(isset($success)&&$success==""){
                    echo "<span style = 'color: red'>Đăng ký thất bại, hãy thử lại</span>";
                }
            
                ?>
                <h1>Đăng nhập</h1>
                
                <div class="social-icons">
                    <a href="javascript:void(0)"><i class='bx bxl-google-plus' ></i></a>
                    <a href="javascript:void(0)"><i class='bx bxl-facebook' ></i></a>
                    <a href="javascript:void(0)"><i class='bx bxl-github' ></i></a>
                    <a href="javascript:void(0)"><i class='bx bxl-linkedin' ></i></a>
                </div>
                <span>hoặc đăng nhập bằng tài khoản</span>
                <input type="hidden" id="action-login" value="dangnhap">
                <input type="text" class="username" id="username-login" name="username" placeholder="Tên đăng nhập">
                <div id="error-login">
                <?php
                    if (isset($err)&&$err!="") {
                        echo "<span style = 'color: red'>".$err."</span>";
                        
                    }
                    
                ?>
                </div>
                
                <input type="password" class="password" id="password-login" name="password" placeholder="Mật khẩu">
                <a href="#">Bạn đã quên mật khẩu ?</a>
                
                <button type="button" onclick="submitDataLogin();" id="dangnhap" name="dangnhap" value="Đăng Nhập">Đăng Nhập</button>
                
            </form>
            
            
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bạn đã có tài khoản?</h1>
                    <p>Hãy đăng nhập để sử dụng được đầy đủ tính năng của chúng tôi</p>
                    <button class="hidden" id="login">Đăng nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Chưa có tài khoản?</h1>
                    <p>Hãy đăng ký tài khoản để sử dụng được đầy đủ tính năng của chúng tôi</p>
                    <button class="hidden" id="register">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
    <script src="public/js/login.js"></script>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    function submitDataLogin(){
        $(document).ready(function(){
            var data = {
                username: $('#username-login').val(),
                password: $('#password-login').val(),
                action:   $('#action-login').val(),
            };
            $.ajax({
                url:'auth',
                method:'post',
                data: data,
                success:function(response){
                    if (response == "admin") {
                        showToast('Đăng nhập tài khoản thành công', "success", 1000);
                        setTimeout(function() 
                        {
                        window.location.href= "category";
                        }, 1500);
                        
                    }
                    else if (response =='user') {
                        showToast('Đăng nhập tài khoản thành công', "success", 1000);
                        setTimeout(function() 
                        {
                        window.location.href = "category";
                        }, 1500);
                    }
                    else {
                        var result = $('<div>').html(response).find("#error-login");
                        
                        $('#error-login').html(result.html());
                        showToast('Đăng nhập tài khoản thất bại', "error", 1000);
                    }
                }
            });
        });
    }
    function submitDataDK() {
    var data = {
        username: $('#username-dangky').val(),
        password: $('#password-dangky').val(),
        rpass: $('#rpass-dangky').val(),
        name: $('#name-dangky').val(),
        phone: $('#phone-dangky').val(),
        action: $('#action-dangky').val()
    };

    $.ajax({
        url: 'auth',
        method: 'POST',
        data: data,
        success: function(response) {
            if (response == "success") {
                        showToast('Đăng ký tài khoản thành công', "success", 1000);
                        setTimeout(function() 
                        {
                        window.location.reload();
                        }, 1500);
                        
                    }
                    else{
                        var result = $('<div>').html(response).find(".form-container.sign-up");
                        
                        $('.form-container.sign-up').html(result.html());
                        showToast('Đăng ký tài khoản thất bại', "error", 1000);
                    }
        }
       
        
    });
}


// hàm hiển thị thông báo 
let toastTop = 20;

function showToast(message, type = 'success', duration = 3000) {
    const toastContainer = document.createElement('div');
    const body = document.querySelector('.main');
    const colors = {
        success: '#47d864',
        info: '#2f86eb',
        warning: '#ffc021',
        error: '#ff6243'
    };
    const color = colors[type] || colors['success']; 

    toastContainer.textContent = message;
    toastContainer.style.backgroundColor = color;
    toastContainer.style.color = 'white';
    toastContainer.style.padding = '7px';
    toastContainer.style.position = 'fixed';
    toastContainer.style.top = `${toastTop}px`;
    toastContainer.style.left = '20px';
    toastContainer.style.border = '1px solid black';
    toastContainer.style.borderRadius = '8px';
    toastContainer.style.fontFamily = 'Poppins, sans-serif';
    toastContainer.style.alignItems = 'center';
    toastContainer.style.transition = 'transform 0.5s ease-in-out, opacity 0.5s ease';

    body.appendChild(toastContainer);

    toastTop += toastContainer.offsetHeight + 20; 

    setTimeout(() => {
        toastContainer.style.transform = 'translateX(-150%)';
        toastContainer.style.opacity = '0';
        setTimeout(() => {
            body.removeChild(toastContainer);
            resetToastPosition();
        }, 500);
    }, duration);
}
function resetToastPosition() {
 if (toastTop>=450) {
  toastTop = 20 
 }
 toastTop = 20
}
</script>