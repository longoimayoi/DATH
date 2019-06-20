<?php include 'header.php'; ?>
<?php include 'connect/myconnect.php';
/*session_start();*/
?>
<body>
  <?php include 'leftpanel.php' ; ?>
  <div class="container">
    <br />
    <div class="table-responsive">
      <h3 align="center">PHIẾU KẾ HOẠCH SỬ DỤNG</h3><br />
      <div class="card-title">
      </div>
      <form method="post">
        <!-- <br /> -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <th width="10%">Mã Phiếu</th>
              <th width="20%">Giảng viên đề nghị</th>
              <th width="15%">Ngày đề nghị</th>
              <th width="20%">Ghi chú</th>
              <th width="20%"></th>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT MaPhieu, HoTen, NgayDeNghi, GhiChu FROM tblphieudenghi, tbltaikhoan where tbltaikhoan.MaTK = tblphieudenghi.MaGV and TrangThai = 'Đang chờ' ORDER BY MaPhieu DESC";
              $query = mysqli_query($connect, $sql);
              while ($row = mysqli_fetch_row($query))
              {
              echo "<tr>";
                echo '<td>'."<p>$row[0]" . "</p>".'</td>';
                echo '<td>'."<p>$row[1]" . "</p>".'</td>';
                echo '<td>'."<p>$row[2]" . "</p>".'</td>';
                echo '<td>'."<p>$row[3]" . "</p>".'</td>';
                echo '<td><a href = '."chi-tiet-phieu-de-nghi.php?item=$row[0]".'>Chi tiết</a></td>';
              echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
  <?php include 'scriptindex.php'; ?>
</body>
</html>