<?php include('connect/myconnect.php');?>
<?php
session_start();
ob_start()?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" http-equiv="Content-Type" content="text/html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hutech - Đăng ký</title>
        <meta name="description" content="Sufee Admin - HTML5 Admin Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-icon.png">
        <link rel="shortcut icon" href="https://www.hutech.edu.vn/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
        <style type="text/css">
        .color{
        color: red;
        }
        #email-error{
        color:red;
        }
        #pass-error{
        color:red;
        }
        #reenter-error{
        color:red;
        }
        </style>
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body class="bg-dark">
        <?php
        //include 'connect/connection';
        if (isset($_POST['btn_submit']))
        {
        $email = $_POST["email"];
        $password = $_POST["pass"];
        $password2 = $_POST["reenter"];
        $md5_p=md5($password2);
        if ($email == "" || $password == "" || $password2 == "" )
        {
        $message= "<p class='color'>Vui lòng nhập đầy đủ thông tin</p>";
        }
        else if ($password != $password2)
        {
        $message= "<p class='color'>Vui lòng nhập lại đúng mật khẩu</p>";
        }
        else
        {
        $sql="select * from tbltaikhoan where TenDangNhap='$email'";
        $query = mysqli_query($connect, $sql);
        $dem = mysqli_num_rows($query);
        if($dem == true)
        {
        $message= "Tài khoản đã tồn tại";
        }
        else
        {
        $sql1 = "INSERT INTO tbltaikhoan
        (
        TenDangNhap,
        MatKhau
        )
        VALUES
        (
        '$email',
        '$md5_p'
        )";
        $query = mysqli_query($connect,$sql1);
        $_SESSION['email']=$email;
        $to =$_SESSION['email'];
        $subject = "=?UTF-8?B?xJDEg25nIGvDrSB0aMOgbmggY8O0bmc=?=";
        $message = 'chào mừng bạn tới với Hutecher';
        $headers = "From: lephuctamslsvt@gmail.com";
        if(mail($to,$subject,$message,$headers)==true)
        {
        header('Location:login.php');
        }
        else
        {
        echo 'false';
        }
        }
        }
        }
        ?>
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="index.html">
                            <img class="align-content" src="images/logo2.jpg" alt="">
                        </a>
                    </div>
                    <div class="login-form" >
                        <form method="post" id='formtk'>
                            <?php
                            if(isset($message))
                            {
                            echo $message;
                            }
                            ?>
                            <div>
                                <div class="form-group">
                                    <label>Email đăng nhập:</label>
                                    <input  type="email" name="email" class="form-control" value="" placeholder="Nhập vào email đăng ký">
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu:</label>
                                    <input id='pass' type="password" name="pass" value="" class="form-control" placeholder="Nhập vào mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu:</label>
                                    <input  type="password" name="reenter" value="" class="form-control" placeholder="Nhập lại mật khẩu">
                                </div>
                                <input  type="submit" name="btn_submit" class="btn btn-primary btn-flat m-b-30 m-t-30" value="Đăng ký">
                                <hr>
                                <div class="register-link m-t-15 text-center">
                                    <p>Đã có tài khoản? <a href="login.php">Đăng nhập tại đây</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
    </body>
</html>
<?php ob_flush()?>
<script type="text/javascript">
$(document).ready(function(){
$('#formtk').validate({
rules:{
email:{
required:true,email:true,
},
pass:{
required:true,minlength:8,
},
reenter:{
required:true,minlength:8,equalTo:'#pass',
},
},
messages:{
email:{
required:'Vui lòng nhập email',email:'Vui lòng nhập đúng định dạng email',
},
pass:{
required:'Vui lòng nhập email',minlength:'Mật khẩu phải trên 8 ký tự',
},
reenter:{
required:'Vui lòng nhập email',minlength:'Mật khẩu phải trên 8 ký tự',equalTo:'Mật khẩu không giống nhau',
},
}
});
});
</script>