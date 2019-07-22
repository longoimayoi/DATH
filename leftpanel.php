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
        <?php
        if (isset($_SESSION["QLK"]))
        {
        ?>
        <li class="menu-item-has-children dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-list"></i>Danh mục</a>
          <ul class="sub-menu children dropdown-menu">
            <li><i class="fa fa-plus"></i><a href="them-danh-muc.php">Thêm danh mục</a></li>
            <li><i class="fa fa-list-alt"></i><a href="danh-muc-vat-tu.php">Danh sách danh mục</a></li>
          </ul>
        </li>
        <?php }?>
        <!--  <li class="menu-item-has-children dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-list"></i>Năm học</a>
          <ul class="sub-menu children dropdown-menu">
            <li><i class="fa fa-list-alt"></i><a href="danh-sach-nam-hoc.php">Danh sách năm học</a></li>
          </ul>
        </li> -->
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
        <?php }
        if (isset($_SESSION["YCTBVT"]) || isset($_SESSION["BG"])  || isset($_SESSION["QLK"])|| isset($_SESSION["DP_LDDV"]) || isset($_SESSION["DP_NVPQT"]) || isset($_SESSION["DP_LDPQT"])|| isset($_SESSION["DP_BGH"]))
        {
        ?>
        <li class="menu-item-has-children dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-pencil-alt"></i>Đề nghị vật tư </a>
          <ul class="sub-menu children dropdown-menu">
            <li><i class="fa fa-list-alt"></i><a href="danhsach-phieu-yeu-cau-trangbi.php">Danh sách phiếu</a></li>
            <?php if(isset($_SESSION["YCTBVT"])|| isset($_SESSION["DP_BGH"]) || isset($_SESSION["QLK"])) { ?>
            <li><i class="fa fa-eye"></i><a href="lich-su-de-xuat-phieu.php">Lịch sử phiếu đề xuất</a></li>
            <?php }if(isset($_SESSION["DP_NVPQT"])){ ?>
            <li><i class="fa fa-list-alt"></i><a href="danh-sach-phieu-cho-tong-hop.php">Tổng hợp phiếu</a></li>
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
            <a id="menuToggle" class="menutoggle pull-left"></a>
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
              $lddv = 0;
              $YCTBVT=0;
              $status = array();
              if (isset($_SESSION['BG']))
              {
              array_push($status, 0);
              }
              if (isset($_SESSION['DP_NVPQT']))
              {
              array_push($status, 10);
              }
              if (isset($_SESSION['DP_LDPQT']))
              {
              array_push($status, 1);
              }
              if (isset($_SESSION['DP_LDDV']))
              {
              $lddv = 1;
              array_push($status, 8);
              }
              if (isset($_SESSION['DP_BGH']))
              {
              array_push($status, 2);
              }
              if (isset($_SESSION['QLK']))
              {
              array_push($status, 6);
              }
              if (isset($_SESSION['YCTBVT']))
              {
              $YCTBVT=1;
              array_push($status, 5);
              }
              $strStatus = implode(",", $status);
              if($strStatus!="")
              {
              if ($YCTBVT == 1)
              {
              $sqlCount = "SELECT TrangThai, COUNT(MaHD) as Dem from tblhoadon WHERE TrangThai in ($strStatus)
              AND MaTK=".$_SESSION['uid']." GROUP BY TrangThai";
              $queryCount = mysqli_query($connect, $sqlCount);
              $demPhieu = array();
              while($rowCount=mysqli_fetch_assoc($queryCount))
              {
              $demPhieu[$rowCount["TrangThai"]] = $rowCount["Dem"];
              }
              $sqlCountAll = "SELECT * from tblhoadon WHERE TrangThai in ($strStatus)     AND MaTK=".$_SESSION['uid']."";
              $queryCountAll = mysqli_query($connect, $sqlCountAll);
              $countall = mysqli_num_rows($queryCountAll);
              }elseif ($lddv == 0)
              {
              $sqlCount = "SELECT TrangThai, COUNT(MaHD) as Dem from tblhoadon WHERE TrangThai in ($strStatus) GROUP BY TrangThai";
              $queryCount = mysqli_query($connect, $sqlCount);
              $demPhieu = array();
              while($rowCount=mysqli_fetch_assoc($queryCount))
              {
              $demPhieu[$rowCount["TrangThai"]] = $rowCount["Dem"];
              }
              $sqlCountAll = "SELECT * from tblhoadon WHERE TrangThai in ($strStatus)";
              $queryCountAll = mysqli_query($connect, $sqlCountAll);
              $countall = mysqli_num_rows($queryCountAll);
              }
              else{
              $maKhoa = $_SESSION['MaKhoa'];
              $sqlCount = "SELECT TrangThai, COUNT(MaHD) as Dem from tblhoadon WHERE MaKhoa = $maKhoa and TrangThai in ($strStatus) GROUP BY TrangThai";
              $queryCount = mysqli_query($connect, $sqlCount);
              $demPhieu = array();
              while($rowCount=mysqli_fetch_assoc($queryCount))
              {
              $demPhieu[$rowCount["TrangThai"]] = $rowCount["Dem"];
              }
              $sqlCountAll = "SELECT * from tblhoadon WHERE MaKhoa = $maKhoa and TrangThai in ($strStatus)";
              $queryCountAll = mysqli_query($connect, $sqlCountAll);
              $countall = mysqli_num_rows($queryCountAll);
              }
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
                  <?php if(array_key_exists(6, $demPhieu)) {?>
                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span>
                    <span class="message media-body">
                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                      <p style="background-color: #b0afab" class="alert badge-pill badge-warning"><?php  echo $demPhieu[6]  ." phiếu yêu cầu đang chờ quản lý kho duyệt" ?></p>
                    </span>
                  <?php } else ""; ?> </a>
                  <?php if(array_key_exists(8, $demPhieu)) {?>
                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span>
                    <span class="message media-body">
                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                      <p style="background-color: #98979669" class="alert badge-pill badge-warning"><?php  echo $demPhieu[8]  ." phiếu yêu cầu đang chờ lãnh đạo đơn vị duyệt" ?></p>
                    </span>
                  <?php } else ""; ?>   </a>
                  <?php if(array_key_exists(0, $demPhieu)) {?>
                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span>
                    <span class="message media-body">
                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                      <p style="background-color: #ba60c9;" class="alert badge-pill badge-warning"><?php  echo $demPhieu[0]  ." phiếu yêu cầu đang chờ báo giá" ?></p>
                    </span>
                  <?php } else ""; ?> </a>
                  <?php if(array_key_exists(1, $demPhieu)) {?>
                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span>
                    <span class="message media-body">
                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                      <p style="background-color: #cd9513;" class="alert badge-pill badge-warning"><?php  echo $demPhieu[1]  ." phiếu yêu cầu đang chờ lãnh đạo phòng quản trị duyệt" ?></p>
                    </span>
                  <?php } else ""; ?> </a>
                  <?php if(array_key_exists(2, $demPhieu)) {?>
                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span>
                    <span class="message media-body">
                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                      <p style="    background-color: #e86b0f" class="alert badge-pill badge-warning"><?php  echo $demPhieu[2]  ." phiếu yêu cầu đang chờ ban giám hiệu duyệt" ?></p>
                    </span>
                  <?php } else ""; ?> </a>
                  <?php if(array_key_exists(10, $demPhieu)) {?>
                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span>
                    <span class="message media-body">
                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                      <p style="background-color: #b7ab8a;" class="alert badge-pill badge-warning"><?php  echo $demPhieu[10]  ." phiếu yêu cầu đang chờ tổng hợp" ?></p>
                    </span>
                  <?php } else ""; ?> </a>
                  <?php if(array_key_exists(5, $demPhieu)) {?>
                  <a class="dropdown-item media " href="danhsach-phieu-yeu-cau-trangbi.php">
                    <span class="photo media-left"><img alt="avatar" src="images/avatar/1.png"></span>
                    <span class="message media-body">
                      <span class="name float-left"><?php echo $_SESSION['Username'] ?></span>
                      <p style="background-color: #7ec960"class="alert badge-pill badge-warning"><?php  echo $demPhieu[5]  ." phiếu yêu cầu đang chờ thêm vật tư" ?></p>
                    </span>
                  <?php } else ""; ?> </a>
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