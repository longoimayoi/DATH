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
    <meta charset="utf-8">
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
    include('connect/myconnect.php');
    $email=isset($_GET['email']) ? $_GET['email']:'';
    $token=isset($_GET['token'])? $_GET['token']: '';
    if($email=='')
    {
    $_SESSION['error']='không tồn tại email';
    header('Location: index.php');
    }
    if($token== '')
    {
    $_SESSION['error']='không tồn tại token';
    header('Location: index.php');
    }
    $sql_check="SELECT MaTK FROM tbltaikhoan WHERE TenDangNhap='".$email."' AND token='".$token."'";
    $query_token=mysqli_query($connect,$sql_check)or die("lỗi truy cập TOKEN");
    $user=mysqli_fetch_array($query_token);
    if($user==NULL)
    {
    $_SESSION['error']='không tồn tại email hoặc token';
    header('Location: index.php');
    }
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
    $error=array();
    /* $mkmoi=!emty(md5($_POST['mkmoi'])) ? md5($_POST['mkmoi']): '';
    if($mkmoi=='')
    {
    $error[]='mời bạn nhập Password';
    }
    if(empty($mkmoi))
    {*/
    $mkmoi=md5($_POST['mkmoi']);
    if($mkmoi != md5($_POST['xnmkmoi']))
    {
    $message=  "<p class='required'>không trùng mật khẩu  </p>" ;
    }
    else
    {
    $query_ud="UPDATE tbltaikhoan SET MatKhau='$mkmoi' WHERE TenDangNhap='".$email."'";
    $result_up=mysqli_query($connect,$query_ud)or die(" lỗi truy vấn insert token");
    if(mysqli_affected_rows($connect)==1)
    {
    $message="<p class='required'> thành công</p>";
    echo("<script>location.href = '"."login.php';</script>");
    }
    else
    {
    $message="<p class='required'>Không thành công</p>";
    }
    }
    //}
    
    }
    else
    {
    $message="<p class='required'>Chưa nhập gì cả</p>";
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
            <form method="post">
              <?php
              if(isset($message))
              {
              echo $message;
              }
              ?>
              <div class="form-group">
                
                <label>Email:</label>
                <input type="text" name="Username" value="<?php
                echo $_SESSION['ten']; ?>"  class="form-control" disabled >
                
              </div>
              
              <div class="form-group" >
                <label>Password:</label>
                <input type="Password" name="mkmoi" value="" class="form-control" placeholder="Password mới">
              </div>
              <div class="form-group" >
                
                <label>xác nhận Password </label>
                <input type="Password" name="xnmkmoi" value="" class="form-control" placeholder="xác nhận Password">
              </div>
              <input type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30" value="Lưu" >
              <hr>
              <div class="register-link m-t-15 text-center">
                <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
              </div>
              <div class="register-link m-t-15 text-center">
                <p><a href="login.php">Đăng nhập</a></p>
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
</body>
</html>