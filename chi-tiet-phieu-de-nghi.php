<?php
include 'header.php'; ?>
<?php include('connect/myconnect.php');
$id = $_GET["item"];
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<body>
  <?php include 'leftpanel.php' ; ?>
  <div class="content mt-3">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-lg-10">
          <div class="card">
            <div class="card-header">
              <strong>Chi tiết phiếu <?php echo $id ?></strong>
            </div>
            <div class="card-body card-block">
              <!--             <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Mã phiếu:</label></div>
                  <div class="col-12 col-md-8">
                    <p class="form-control-static"><?php echo $id ?></p>
                  </div>
                </div>
              </div> -->
              
              <!-- <div style="display:block;" class="row form-group"> -->
              
              
              <div class="container">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <th width="20%">Hóa chất</th>
                      <th width="20%">Số lượng</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "Select TenHoaChat, SL from tblctphieudenghi, tblhoachat where MaPhieu = $id and tblhoachat.id = tblctphieudenghi.MaHoaChat ";
                      $query = mysqli_query($connect, $sql);
                      while ($row = mysqli_fetch_row($query))
                      {
                      ?>
                      <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table id='bootstrap-data-table' class='table table-striped'>
                </div>
              </div>
              
              <?php
              if (isset($_POST["btn_submit"]))
              {
              $sql = "update tblphieudenghi set TrangThai = 'Đã duyệt' where MaPhieu = $id ";
              $query = mysqli_query($connect, $sql);
              $message = "Đã duyệt !";
              echo "<script type='text/javascript'>alert('$message');</script>";
              echo("<script>location.href = '"."requirelist.php';</script>");
              }
              if (isset($_POST["btn_cancel"]))
              {
              $sql = "update tblphieudenghi set TrangThai = 'Đã hủy' where MaPhieu = $id ";
              $query = mysqli_query($connect, $sql);
              $message = "Đã hủy !";
              echo "<script type='text/javascript'>alert('$message');</script>";
              echo("<script>location.href = '"."requirelist.php';</script>");
              }
              ?>
              <form method = "post">
                <div id="row">
                  <div class="submit" style="float: right;margin-right: 15px">
                    <button type="submit" name="btn_submit">Duyệt</button>
                    <button type="submit" style="background-color: #ff0000d6"name ="btn_cancel">Hủy</button>
                  </div>
                </div>
              </form>
              <br/ >
              <?php include 'scriptindex.php'; ?>
            </body>