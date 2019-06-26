<?php include 'connect/myconnect.php'; ?>
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="images/hutechmt.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logoadmin.png" alt="Logo"></a>
        </div>
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <!--  <li class="active">
                    <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Bảng điều khiển</a>
                </li> -->
                <h3 class="menu-title">Chức năng</h3><!-- /.menu-title -->
                <?php
                if (isset($_SESSION["QLTK"]))
                {
                    ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-user"></i>Quản lý tài khoản</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-list-alt"></i><a href="danh-sach-tai-khoan.php">Danh sách tài khoản</a></li>

                        </ul>
                    </li>
                <?php }?>

        
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-list"></i>Danh mục</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i><a href="them-danh-muc.php">Thêm danh mục</a></li>
                        <li><i class="fa fa-list-alt"></i><a href="danh-muc.php">Danh sách danh mục</a></li>
                    </ul>
                </li>
        
                <?php
            if (isset($_SESSION["QLVT"]))
            {
                ?>
                <li class="menu-item-has-children dropdown">
                    <a href="khoa.php" class="dropdown-toggle"  aria-haspopup="true" > <i class="menu-icon ti-calendar"></i>Khoa - Môn học</a>
                </li>
            <?php }?>


            <?php
            if (isset($_SESSION["QLVT"]))
            {
                ?>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-ruler-pencil"></i>Quản lý vật tư</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-plus"></i><a href="them-hoa-chat.php">Thêm vật tư</a></li>
                        <li><i class="fa fa-list-alt"></i><a href="danh-sach-hoa-chat.php">Danh sách vật tư</a></li>
                    </ul>
                </li>
            <?php }?>
       
               <?php
                if (isset($_SESSION["QLK"]))
                {
                    ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-home"></i>Quản lý kho</a>
                        <ul class="sub-menu children dropdown-menu">
                                 <li><i class="fa fa-plus"></i><a href="danh-sach-phieu-nhap-kho.php">Nhập kho</a></li>
                                <li><i class="fa fa-share-square-o"></i><a href="danh-sach-phieu-xuat-kho.php">Xuất kho</a></li>
                                <li><i class="fa fa-check-square-o"></i><a href="kiem-ke.php">Kiểm kê</a></li>
                        </ul>
                    </li>
                <?php }?>

            <?php
                if (isset($_SESSION["YCTBVT"]) || isset($_SESSION["BG"]) || isset($_SESSION["DPYCTB"]))
                {
                    ?>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-pencil-alt"></i>Đề nghị vật tư </a>
                    <ul class="sub-menu children dropdown-menu">
                      
                        <li><i class="fa fa-list-alt"></i><a href="danhsach-phieu-yeu-cau-trangbi.php">Danh sách phiếu</a></li>
                        <?php if(isset($_SESSION["YCTBVT"]) && isset($_SESSION["DPYCTB"]) ) { ?>
                        <li><i class="fa fa-list-alt"></i><a href="lich-su-de-xuat-phieu.php">Theo dõi phiếu đề xuất</a></li>
                       <?php } elseif (isset($_SESSION["YCTBVT"]))
                      {?>
                      <li><i class="fa fa-list-alt"></i><a href="lich-su-de-xuat-phieu.php">Theo dõi phiếu đề xuất</a></li>
                      <?php }
                      elseif (isset($_SESSION["DPYCTB"]))
                      {?>
                      <li><i class="fa fa-list-alt"></i><a href="lich-su-de-xuat-phieu.php">Lịch sử duyệt phiếu</a></li>
                      <?php } ?>
                    </ul>
                </li>
              <?php } ?>
              
            
             
                <!-- <h3 class="menu-title">Thêm</h3>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Trang</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="login.php">Đăng nhập</a></li>
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="register.php">Đăng ký</a></li>
                        <li><i class="menu-icon fa fa-paper-plane"></i><a href="forget.php">Quên mật khẩu</a></li>
                    </ul>
                </li> -->
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
<!-- Left Panel -->
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="header-menu">
            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                <div class="header-left">

                    <div class="form-inline">
                        <form class="search-form">
                            <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search"> -->
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                            <!--  <div class="dropdown for-notification">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="notification">
                                    <p class="red">You have 3 Notification</p>
                                    <a class="dropdown-item media bg-flat-color-1" href="#">
                                        <i class="fa fa-check"></i>
                                        <p>Server #1 overloaded.</p>
                                    </a>
                                    <a class="dropdown-item media bg-flat-color-4" href="#">
                                        <i class="fa fa-info"></i>
                                        <p>Server #2 overloaded.</p>
                                    </a>
                                    <a class="dropdown-item media bg-flat-color-5" href="#">
                                        <i class="fa fa-warning"></i>
                                        <p>Server #3 overloaded.</p>
                                    </a>
                                </div>
                            </div> -->
  
                          <?php 
                          if( isset($_SESSION['YCTBVT']) && isset($_SESSION['DPYCTB']) && isset($_SESSION['BG']))
                            {
                              $query="SELECT TrangThai FROM tblhoadon WHERE 
                              TrangThai !=2  AND TrangThai!=4 ";
                            
                          }elseif(isset($_SESSION['YCTBVT']) && isset($_SESSION['BG']))
                            {
                              $query="SELECT TrangThai FROM tblhoadon WHERE 
                              TrangThai !=2 AND TrangThai!=4 AND TrangThai!=1  ";
                               
                              }elseif( isset($_SESSION['YCTBVT']) && isset($_SESSION['DPYCTB']))
                            {
                              $query="SELECT TrangThai FROM tblhoadon WHERE 
                              TrangThai !=2 AND TrangThai!=0 AND TrangThai!=4 ";
                            
                          }elseif(isset($_SESSION['DPYCTB']) && isset($_SESSION['BG']))
                            {
                               $query="SELECT TrangThai FROM tblhoadon WHERE 
                               TrangThai !=2 AND TrangThai!=4 AND TrangThai !=5  ";
                                $result=mysqli_query($connect,$query); 
                            }elseif(isset($_SESSION["YCTBVT"]))
                          {
                          $query="SELECT TrangThai FROM tblhoadon WHERE TrangThai !=2 AND TrangThai !=4 AND TrangThai !=0
                          AND TrangThai !=1 AND MaTK=".$_SESSION['uid']." ";
                         
                        }elseif(isset($_SESSION["BG"])){
                            $query="SELECT TrangThai FROM tblhoadon WHERE TrangThai !=2 AND TrangThai !=4 AND TrangThai !=5 AND TrangThai !=1 ";
                         
                        }elseif(isset($_SESSION["DPYCTB"])){
                            $query="SELECT TrangThai FROM tblhoadon WHERE TrangThai !=0 AND TrangThai !=4 AND TrangThai !=5 AND TrangThai !=2";
                          
                        }
                        $result=mysqli_query($connect,$query); 
                          while ($item=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                              if($item['TrangThai']==5)
                              {
                                  $chothemvt[]=$item['TrangThai'];
                                  $countCTVT=count($chothemvt);
                              }
                              if($item['TrangThai']==0)
                              {
                                  $baogia[]=$item['TrangThai'];
                                  $countBG=count($baogia);
                              }
                              if($item['TrangThai']==1)
                              {
                                  $choduyet[]=$item['TrangThai'];
                                  $countCD=count($choduyet);
                              }
                              $count[]=$item['TrangThai'];
                              $countall=count($count);
                           }         
                          ?>
                          <div class="dropdown for-message">
                              <button class="btn btn-secondary dropdown-toggle" type="button"
                              id="message"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="ti-bell"></i>
                              <span class="count bg-primary">
                          
                                  <?php if(isset($countall)) {echo $countall;} else echo 0;?></span>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="message" style="border: 1px solid rgba(159, 159, 178, 0.32);padding-top:0px;margin-top: 5px">
                                 <?php if(isset($countall)) {?>
                                  <p class="alert badge-pill badge-info"><?php echo
                                  " ".$countall." phiếu yêu cầu "; ?> </p><?php } ?>
                                  <?php if(isset($countCD)) {?>
                                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                                   <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span> 
                                   <span class="message media-body">
                                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                                      <p class="alert badge-pill badge-warning"><?php  echo $countCD  ." phiếu yêu cầu đang chờ duyệt" ?></p>
                                  </span>
                                  <?php } else ""; ?>
                                   <?php if(isset($countBG)) {?>
                                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                                   <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span> 
                                   <span class="message media-body">
                                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                                      <p class="alert badge-pill badge-primary"><?php echo $countBG . " phiếu yêu cầu đang chờ báo giá" ?>   </p>
                                  </span>
                                   <?php } else ""; ?>
                                  <?php if(isset($countCTVT)) {?>
                                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                                   <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span> 
                                   <span class="message media-body">
                                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                                      <p class="alert badge-pill badge-info"><?php echo $countCTVT . " Phiếu yêu cầu đang chờ thêm vật tư" ?>   </p>
                                  </span>
                                   <?php } else ""; ?>
                              </a>
                           
                              </div>
                              
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="user-area dropdown float-right">
                            <div class="user-area dropdown float-left" style="/*text-decoration:underline*/; padding-top: 10px">
                                <?php echo "Xin chào " ,$_SESSION['Username']," " ?>
                            </div>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                            </a>
                            <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="thong-tin-ca-nhan.php"><i class="fa fa-user"></i>  Thông tin tài khoản</a>
                                <!-- <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span class="count">13</span></a> -->
                                <a class="nav-link" href="doi-mat-khau.php"><i class="fa fa-cog"></i>  Đổi mật khẩu</a>
                                <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>  Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
                </header><!-- /header -->