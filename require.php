<?php
include 'header.php'; ?>
<?php include('connect/myconnect.php');?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<body>
  <?php include 'leftpanel.php' ; ?>
  <?php
  if(isset ($_POST["btn_submit"]))
  {
  if (isset($_SESSION['cart']))
  {
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  //echo date('Y-m-d H:i:s')
  $magv=$_SESSION['uid'];
  $date=date('Y-m-d H:i:s');
  //   $yeucau=$_POST['yeucau'];
  //  $soluong=$_POST['soluong'];
  $trthai='Đang chờ';
  $ghichu=$_POST['ghichu'];
  $query="INSERT INTO tblphieudenghi(MaGV,NgayDeNghi,TrangThai,GhiChu) VALUES
  ('$magv','$date','$trthai','$ghichu')";
  $result=mysqli_query($connect,$query);
  $a=mysqli_insert_id($connect);
  foreach($_SESSION['cart'] as $key=>$value)
  {
  $i = $_SESSION['cart'][$key];
  $sql1 = "INSERT INTO tblctphieudenghi
  (MaPhieu,MaHoaChat, SL)
  VALUES
  ('$a','$key', '$i')";
  $query = mysqli_query($connect,$sql1);
  }
  $message = "Đề nghị thành công !";
  echo "<script type='text/javascript'>alert('$message');</script>";
  }
  else
  $message = "Chưa chọn hóa chất cần đề nghị !";
  echo "<script type='text/javascript'>alert('$message');</script>";
  }
  ?>
  <div class="content mt-3">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>Kế hoạch sử dụng hóa chất</strong>
            </div>
            <div class="card-body card-block">
              <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Giảng viên:</label></div>
                  <div class="col-12 col-md-8">
                    <p class="form-control-static"><?php echo $_SESSION['Username'] ?></p>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Ngày yêu cầu:</label></div>
                  <div class="col-12 col-md-8"><p> <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                  echo date('Y-m-d H:i:s')?></p>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Hóa chất yêu cầu:</label></div>
                <div class="col-12 col-md-8">
                  <div id='cart'>
                    <?php
                    $ok=0;
                    if(isset($_SESSION['cart']))
                    {
                    foreach($_SESSION['cart'] as $k=>$v)
                    {
                    if(isset($v))
                    {
                    $ok=1;
                    }
                    }
                    }
                    if ($ok != 1)
                    {
                    echo '<p>Vui lòng chọn hóa chất cần đề nghị !</p>';
                    } else {
                    $items = $_SESSION['cart'];
                    echo '<p>Đã chọn <a href="cart.php">'.count($items).' hóa chất</a></p>';
                    }
                    ?>
                  </div>
                  <div>
                    <button type="submit" name="btn_select">Chọn hóa chất</button>
                    <?php if(isset($_POST["btn_select"]))
                    echo("<script>location.href = '"."chon-hoa-chat.php';</script>");
                    ?>
                  </div>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Ghi chú:</label></div>
                <div class="col-12 col-md-8"><textarea name="ghichu" id="ghichu" rows="5" placeholder="Nhập thêm ghi chú nếu có..." class="form-control"></textarea>
                </div>
              </div>
              <div id="row">
                <div class="submit" style="float: right;margin-right: 1px">
                  <button type="submit" name="btn_submit">
                  Gửi
                  </button>
                  <button type="reset">
                  Đặt lại
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'scriptindex.php'; ?>
</body>
</html>