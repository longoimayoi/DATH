<style>
  .callback{
    font-size: 16px;
    padding: 5px 40px;
    position: relative;
    background-color: #ff0000d6;
    color: #FFF;
    border: none;
    border-radius: 0px;
    outline: none;
    float: none;
    cursor: pointer;
    border-radius: 25px;
    box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.2);
    overflow: hidden;
    opacity: 0.9;
}
</style>
<?php include 'header.php';
ob_start();
include('connect/myconnect.php');?>
<body>  
  <?php include 'leftpanel.php' ; ?>
  <div class="container">  
    <br />
    <div class="table-responsive">  
      <h4 align="center">DANH SÁCH PHIẾU CHỜ TỔNG HỢP</h4><br />
      <?php 
      if (isset($_POST['submit']) && isset($_POST['MaPhieu']))
      {
        $MaPhieu = $_POST['MaPhieu'];
        $listCheck = implode(",",$MaPhieu);

        
        //Lay DS MonHoc theo checkbox
        $sqlGetListMonHoc = "SELECT DISTINCT MonHoc FROM tblhoadon WHERE TrangThai = 10 AND MaHD in ($listCheck) ";
        $queryMonHoc = mysqli_query($connect, $sqlGetListMonHoc);

         //Lay DS NhomLop theo checkbox
        $sqlGetListNhomLop = "SELECT DISTINCT NhomLop FROM tblhoadon WHERE TrangThai = 10 AND MaHD in ($listCheck) ";
        $queryNhomLop = mysqli_query($connect, $sqlGetListNhomLop);

          //Lay NamHoc moi nhat
        $sqlGetNamHoc = "SELECT id, NamHoc FROM namhoc ORDER BY id DESC LIMIT 1 ";
        $queryNamHoc = mysqli_query($connect, $sqlGetNamHoc);
        $rowNamHoc = mysqli_fetch_assoc($queryNamHoc);

          //Lay DS MaPhieu theo checkbox
        $sqlGetListMaPhieu = "SELECT  MaHD FROM tblhoadon WHERE TrangThai = 10 AND MaHD in ($listCheck) ";
        $queryMaPhieu = mysqli_query($connect, $sqlGetListMaPhieu);

        //Lay SLSV
        $sqlSum = "SELECT SLSV FROM tblhoadon WHERE TrangThai = 10 AND MaHD in($listCheck)";
        $querySum = mysqli_query($connect, $sqlSum);
        //echo $rowSum[1];
        $slsvTotal = 0;
        $arraySLSV = array();
        $count = 0;
        while($rowSum = mysqli_fetch_array($querySum))
        {
          $count ++;
          $arraySLSV[$count] = $rowSum['SLSV'];
        }
        foreach ($arraySLSV as $key => $value) {
          $slsvTotal = $slsvTotal + $value ;
        }
        //echo $slsvTotal;
        //
        $arrayNhomLop = array();
        $arrayMonHoc = array();
        $arraySLSV = array();
        $arrayMaPhieu = array();
        $i = 0;
        while ($rowGetListMonHoc = mysqli_fetch_assoc($queryMonHoc))
        {
          $i++;
             $arrayMonHoc[$i]=$rowGetListMonHoc['MonHoc'];
        }
        $strMonHoc = "";
        foreach ($arrayMonHoc as $key => $value) {
          $strMonHoc .= $value . ",";
        }
        //echo $strMonHoc;
        $j = 0;
         while ($rowGetListNhomLop = mysqli_fetch_assoc($queryNhomLop))
        {
          $j++;
             $arrayNhomLop[$j]=$rowGetListNhomLop['NhomLop'];
        }

          $strNhomLop = "";
        foreach ($arrayNhomLop as $key => $value) {
          $strNhomLop .= $value . " ";
        }
       // echo $strNhomLop;

        $z = 0;
         while ($rowGetListMaPhieu = mysqli_fetch_assoc($queryMaPhieu))
        {
          $z++;
             $arrayMaPhieu[$z]=$rowGetListMaPhieu['MaHD'];
        }

          $strMaPhieu = "";
        foreach ($arrayMaPhieu as $key => $value) {
          $strMaPhieu .= $value . " ";
        }
       // echo $strMaPhieu;
   date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today=date("Y-m-d H:i:s");
    $uid = $_SESSION["uid"];
    $nh = $rowNamHoc["id"];
        $sqlInsert = "INSERT INTO tblhoadon (MaTK, MonHoc, NhomLop, NamHoc, SLSV, NgayLapPhieu, TrangThai, PhieuDuocTongHop) VALUES ('$uid','$strMonHoc','$strNhomLop','$nh','$slsvTotal','$today',0,'$strMaPhieu')";
        $queryInsert = mysqli_query($connect, $sqlInsert);

         $MaHD=mysqli_insert_id($connect);
        $mp = explode(" ",$strMaPhieu);
        $mpimp = implode(",",$mp);
        $mprtrim=rtrim($mpimp,", ");
        $sqlGroupBy = "SELECT MaVatTu, TenVatTu, DVT, SUM(SL) AS SL, ThongSoKT, XuatXu FROM tblphieuyeucautrangbi WHERE MaHD in ($mprtrim) GROUP BY MaVatTu, ThongSoKT, XuatXu";
        $queryGroupBy = mysqli_query($connect, $sqlGroupBy);
        while ($rowGB = mysqli_fetch_assoc($queryGroupBy)) {
          $mavt = $rowGB["MaVatTu"];
          $tenvt = $rowGB["TenVatTu"];
          $dvt = $rowGB["DVT"];
          $sl = $rowGB["SL"];
          $tskt = $rowGB["ThongSoKT"];
          $xx = $rowGB["XuatXu"];
          $sqlInsertToCTPYC = "INSERT INTO tblphieuyeucautrangbi (MaHD, MaVatTu, TenVatTu, DVT, SL, ThongSoKT, XuatXu) VALUES ('$MaHD','$mavt','$tenvt','$dvt','$sl','$tskt','$xx')";
          $queryInsertToCTPYC = mysqli_query($connect, $sqlInsertToCTPYC);

          $sqlUpdateStatus = "UPDATE tblhoadon set TrangThai = 11 WHERE MaHD in ($listCheck)";
        $queryUpdateStatus = mysqli_query($connect, $sqlUpdateStatus);
          echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");
        }
      }  
    ?>

  <form method="post" id="update_form">
    <div align="left">
      <!-- <input type="button" id="savedl" onclick="window.location.href='chitiet-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $_GET['MaHD']?>'" value="Hoàn thành"/> -->
      <button type="submit" name = "submit">Tổng hợp</button>
     <!-- // <button type="reset" id = "delete">Xóa dữ liệu</button> -->
      <a class="callback" style="float:right;" onclick="window.location.href='chitiet-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $_GET['MaHD']?>'">Trở lại</a>
  </div>

  <br />
  <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <th width="1%"> <input type="checkbox" name="select-all" id="select-all" /></th>
          <th style="text-align: center" width="20%">Người lập phiếu</th>
          <th style="text-align: center"  width="20%">Môn học</th>
          <th style="text-align: center" width="10%">Lớp</th>
          <th style="text-align: center" width="10%">Số lượng sv</th>
          <th style="text-align: center"  width="10%">Ngày lập</th>
          <th style="text-align: center" width="20%">Ghi chú</th>
          <th width="5%"></th>
      </thead> 
      <tbody>
        <?php 
        $sql = "SELECT HoTen, MaHD, MonHoc, NhomLop, SLSV, NgayLapPhieu, GhiChu FROM tblhoadon hd, tbltaikhoan tk WHERE hd.TrangThai = 10 AND hd.MaTK = tk.MaTK";
        $query = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($query)) {

         ?>
         <tr>   
          <th><input type="checkbox" class="check_box" name="MaPhieu[]" value = "<?php echo $row['MaHD'] ?>"></th>  
          <th style="font-weight: normal;"> <?php echo $row['HoTen'] ?></th>
          <th style="font-weight: normal;"> <?php echo $row['MonHoc'] ?></th>
          <th style="font-weight: normal;"> <?php echo $row['NhomLop'] ?></th>
          <th style="font-weight: normal;"> <?php echo $row['SLSV'] ?></th>
          <th style="font-weight: normal;"> <?php echo $row['NgayLapPhieu'] ?></th>
          <th style="font-weight: normal;"> <?php echo $row['GhiChu'] ?></th>
          <th></th> 

      </tr>
  <?php } ?>
</tbody>
</table>
</div>

</form>
</div>
</div>

<?php include 'scriptindex.php'; ?>
</body>  

</html>
<?php ob_flush(); ?>
<script >
  $('#select-all').click(function(event) {
      if(this.checked) {
          $('.check_box').each(function() {
              this.checked = true;

          });
      }
      else {
        $('.check_box').each(function() {
          this.checked = false;

      });
    }
});
  $('.check_box').click(function(event) {
    $('#select-all').prop("checked", false);
});
</script>
