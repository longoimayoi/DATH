<?php
session_start();
ob_start();
if(isset($_SESSION['uid']))
{
exit(header('Location: index.php'));
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hutech - Đăng nhập</title>
        <meta name="description" content="Sufee Admin - HTML5 Admin Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-icon.png">
        <link rel="shortcut icon" href="https://www.hutech.edu.vn/favicon.ico" type="image/x-icon"/>
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
        $error=array();
        if(empty($_POST['Username']))
        {
        $error[]=$_POST['Username'];
        }
        else
        {
        $Username=$_POST['Username'];
        }
        if(empty($_POST['password']))
        {
        $error[]=$_POST['password'];
        }
        else
        {
        $password=md5(($_POST['password']));
        }
        if(empty($error))
        {
        $query="SELECT MaTK,TenDangNhap,MatKhau,MaQH,TrangThai,MaKhoa,HoTen FROM tbltaikhoan WHERE
        TenDangNhap='{$Username}'AND MatKhau='{$password}' ";
        $result=mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
        if(mysqli_num_rows($result)==1)
        {
        
        list($id,$Username,$password,$MaQH,$TrangThai,$MaKhoa,$HoTen)=mysqli_fetch_array($result,MYSQLI_NUM);
        $_SESSION['MaKhoa'] = $MaKhoa;
        $_SESSION['uid']=$id;
        $_SESSION['Username']=$Username;
        $_SESSION['HoTen'] = $HoTen;
        $a=$MaQH;
        $b=explode(",",$a);
        if(in_array('1',$b))
        {
        $_SESSION['DM'] = 1;
        }
        if(in_array('3',$b))
        {
        $_SESSION['BG'] = 1;
        }
        if(in_array('5',$b))
        {
        $_SESSION['QLVT'] = 1;
        }
        if(in_array('6',$b))
        {
        $_SESSION['YCTBVT'] = 1;
        }
        if(in_array('7',$b))
        {   
        $_SESSION['DPYCTB'] = 1;
        }
      /*  if(in_array('8',$b))
        {
        $_SESSION['QLNCC'] = 1;
        }*/
        if(in_array('9',$b))
        {
        $_SESSION['QLTK'] = 1;
        }
        if(in_array('12',$b))
        {
        $_SESSION['QLK'] = 1;
        }
       /* if(in_array('13',$b))
        {
        $_SESSION['XK'] = 1;
        }*/
        if($TrangThai==1)
        {
            echo("<script>location.href = '"."index.php';</script>");
        }
        else{
            echo "<script>alert('Tài khoản đã bị vô hiệu hóa')</script>";
            unset($_SESSION['uid']);
            echo("<script>location.href = '"."login.php';</script>");
        }
        }
        else
        {
             echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng')</script>";
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
                    <div class="login-form">
                        <form method="post" id = "login_form">
                            <div class="form-group">
                                
                                <label>Email đăng nhập:</label>
                                <input type="text" name="Username" class="form-control" placeholder="Nhập vào email">
                                <?php
                                if(isset($error)&& in_array('Username', $error))
                                {
                                echo "<p class='required'>Chưa nhập email</p>";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập vào mật khẩu">
                                <?php
                                if(isset($error)&& in_array('password', $error))
                                {
                                echo "<p class='required'>Chưa nhập mật khẩu</p>";
                                }
                                ?>
                            </div>
                            <div class="checkbox">
                                <label class="pull-right">
                                    <a href="quenmatkhau.php">Quên mật khẩu?</a>
                                </label>
                            </div>
                            <input type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30" value="đăng nhập" >
                            <hr>
                            <div class="register-link m-t-15 text-center">
                                <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
                            </div>
                            <?php
                            if(isset($message))
                            {
                            echo $message;
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>