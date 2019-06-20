<?php
session_start();
ob_start();

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" content="Content-Type">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hutech - Đăng nhập</title>
        <meta name="description" content="Sufee Admin - HTML5 Admin Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-icon.png">
        <link rel="shortcut icon" href="https://www.hutech.edu.vn/favicon.ico" type="image/x-icon"/>
        <style type="text/css">
        .required{
        color: red;
        }
        #Username-error{
        color:red;
        }
        </style>
        <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
        
    </head>
    <?php include('connect/myconnect.php');?>
    <body class="bg-dark">
        <?php
        
        if(isset($_POST['submit']))
        {
        if($_POST['captcha']==$_SESSION['cap_code'])
        {
        $message="<p style='font-size:20px;' class='required'> Mã xác nhận đúng</p>";
        $Username=$_POST['Username'];
        $query="SELECT MaTk,TenDangNhap,MatKhau,token FROM tbltaikhoan WHERE
        TenDangNhap='{$Username}'";
        $result=mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
        if(mysqli_num_rows($result)==1)
        {
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $token=substr(md5(rand(0,10000)), 0,16);
        $_SESSION['ten']=$Username;
        if(!empty($row))
        {
        $sql_in="UPDATE tbltaikhoan SET token='$token' WHERE TenDangNhap='$Username'";
        $result_in=mysqli_query($connect,$sql_in);
        if(mysqli_affected_rows($connect)==1)
        {
        $to =$_SESSION['ten'];
        $subject = '=?UTF-8?B?UXXDqm4gbeG6rXQga2jhuql1?=';
        $message = "chào ".$to." Đây là địa chỉ URL để xác nhận đổi mật khẩu ! nếu bạn muốn đổi password hãy tích vào
        đây http://localhost:8888/dath/reset_password.php?email=".$Username."&token=".$token." ' ";
        $headers = "From:".$to;
        if(mail($to,$subject,$message,$headers)==true)
        {
        $message="<p style='font-size:20px;' class='required'>mời bạn check mail</p>";
        }
        else
        {
        $message="<p style='font-size:20px;' class='required'> lỗi gửi mail</p>";
        }
        }
        }
        
        
        
        }
        else
        {
        $message="<p style='font-size:20px;' class='required'> Email không tồn tại</p>";
        }
        
        }
        else
        {
        $message="<p style='font-size:20px;' class='required'>mã xác nhận không đúng</p>";
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
                    <div class="login-form">
                        <form method="post" id="formqmk">
                            <?php
                            if(isset($message))
                            {
                            echo $message;
                            }
                            ?>
                            <div class="form-group">
                                
                                <label>Email đăng nhập:</label>
                                <input type="text" name="Username" class="form-control" placeholder="Nhập vào email">
                                <?php
                                if(isset($error))
                                {
                                echo "<p class='required'>Chưa nhập email</p>";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="captcha" id='captcha'>
                                <img src="captcha_code.php">
                            </div>
                            <input type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30" value="Send Email" >
                            <hr>
                            <div class="register-link m-t-15 text-center">
                                <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
                            </div>
                            <div class="register-link m-t-15 text-center">
                                <p><a href="login.php">Đăng nhập</a></p>
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
<script type="text/javascript">
$(document).ready(function(){
$('#formqmk').validate({
rules:{
Username:{
required:true,minlength:8,email:true,
},
},
});
});
</script>