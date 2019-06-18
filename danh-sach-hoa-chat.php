<?php include 'header.php'; 
 include 'leftpanel.php' ;

      // if(isset($_POST['save']))
      // {
      //   $TenVatTu=$_POST['TenVatTu'];
      //   $SLT=$_POST['SLT'];
      //   $DVT=$_POST['DVT'];
      //   $VTD=$_POST['VTD'];
      //   $NgayMoNap=$_POST['NgayMoNap'];
      //   $NgayHetHan=$_POST['NgayHetHan'];
      //   $SoNgayHetHanSMN=$_POST['SoNgayHetHanSMN'];
      //   $query_sl="SELECT * FROM tblhoachat order by id";
      //   $result_sl = mysqli_query($connect, $query_sl);
      //   $query="UPDATE tblhoachat SET TenHoaChat='$TenVatTu',SLT='$SLT',DVT='$DVT',ViTriDat='$VTD',NgayMoNap='$NgayMoNap',NgayHetHan='$NgayHetHan',SoNgayHetHanSMN='$SoNgayHetHanSMN' WHERE id=".$row['id']."";
      //   $result=mysqli_query($connect,$query);
      //   if(mysqli_affected_rows($connect)==1)
      //   {
      //     echo "<script>alert('Sửa thành công')</script>";
      //     echo("<script>location.href = '"."danh-sach-hoa-chat.php';</script>");
      //   }

      // }
      
  ?>
  <div class="container">
    <br />
   <div style="float:right;margin-bottom: -172px;padding: initial;width: 320px">
  <aside class="profile-nav alt">
    <section class="card">
      <div style="height: 35px" class="card-header user-header alt bg-dark">
    
          <div style="margin-top: -4px"class="media-body">
            <p  style="font-weight:bold;color: #ffffffcf">GHI CHÚ: LƯU Ý KHI SỬ DỤNG</p>
          </div>
        
      </div>
      <ul class="list-group list-group-flush">
        <li style="height: 35px;background-color:#f900188f;text-align: center;" class="list-group-item">
          <span style="font-size: 15px;font-style: italic; color: white">HẾT HẠN SỬ DỤNG TRÊN BAO BÌ</span>
          <li  style="height: 35px;background-color:yellow; text-align: center;" class="list-group-item">
            <span style="font-style: italic;font-size: 15px">HẾT HẠN SỬ DỤNG SAU MỞ NẮP</span>
          </li>
        </ul>
      </section>
    </aside>
  </div>
    <div class="table-responsive">
      <h3 align="center">QUẢN LÝ VẬT TƯ</h3><br />
      <div class="card-title">
        <form class="search" method="get" action="">
          <input class="text" type="text" id ="skill_input" name ="btn_search" type="search" placeholder= "Nhập vào tên vật tư cần tìm..." value = "<?php echo isset($_GET["btn_search"]) ? $_GET["btn_search"] : ""; ?>" autocomplete="off">
          <i id="search"class="fa fa-search"></i>
          
        </form>
      </div>
      <?php
      if (isset($_POST["update"]))
      {
        echo("<script>location.href = '"."cap-nhat-thong-tin-hoa-chat.php';</script>");
      }
      if (isset($_POST["delete"]))
      {
        echo("<script>location.href = '"."xoa-hoa-chat.php';</script>");
      }
      ?>
      <form method = "post">
        <div align="left">
          <button type="submit" name="update" id="update">Cập nhật dữ liệu</button>
          <button style="background-color: #ff0000d6"type="submit" name="delete" id="delete">Xóa dữ liệu</button>
        </div>
        
      </form>
      <form method="post">
        
        <br />
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <th width="1%"></th>
              <th width="5%">Mã vật tư</th>
              <th width="15%">Tên vật tư</th>
              <!-- <th width="10%">Công thức</th> -->
              <th width="10%">Số lượng tồn</th>
              <th width="10%">Đơn vị tính</th>
              <!--   <th width="25%">Nguy hiểm chính</th> -->
              <!--       <th width="10%">Chú ý</th> -->
              <th width="10%"title="Vị trí đặt">Vị trí đặt</th>
              <th width="8%">Ngày mở nắp</th>
              <th width="15%">Hạn sử dụng</th>
              <!--     <th width="15%">Yêu cầu khi sử dụng</th> -->
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
  <?php 
    $queryDetail="SELECT * FROM tblhoachat order by id ";
    $resultDetail = mysqli_query($connect, $queryDetail);
    while ($row=mysqli_fetch_array($resultDetail,MYSQLI_ASSOC))
    {
      ?>
      <div class="modal fade" id="xemthongtin<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="max-width: 800px!important;" role="document">
          <div class="modal-content">
      <div class="modal-body">
        <form method="post" action="sua-vat-tu.php?id=<?php echo $row['id'] ?>" enctype="multipart/form-data">
          <div class="row form-group">
            <div class="col col-md-3"><label class="form-control-label">Tên vật tư:</label></div>
            <div class="col-12 col-md-9">
              <input type="text"  value="<?php echo $row['TenHoaChat']; ?>"name="TenVatTu"class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3"><label class=" form-control-label">Số lượng tồn:</label></div>
            <div class="col-12 col-md-9">
              <input type="Number"  value="<?php echo $row['SLT']; ?>"name="SLT"class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3"><label  class=" form-control-label">Đơn vị tính:</label></div>
            <div class="col-12 col-md-9"><input type="text"  value="<?php echo $row['DVT']; ?>"name="DVT" class="form-control"></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3"><label  class=" form-control-label">Vị trí đặt:</label></div>
            <div class="col-12 col-md-9"><input type="text" value="<?php echo $row['ViTriDat']; ?>" name="VTD" class="form-control"></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3"><label  class=" form-control-label">Hình ảnh:</label></div>
            <div style="height: 280px" class="col-12 col-md-9"><img style="height: 80%" src="HinhHoaChat/<?php echo $row['HinhAnh']?>">
               <input type="file" name="hinh"  >
            </div>

          </div>
          <div class="row form-group">
            <div class="col col-md-3"><label class=" form-control-label">Ngày mở nắp:</label></div>
            <div class="col-12 col-md-9"><input type="date"  value="<?php echo $row['NgayMoNap']; ?>"name="NgayMoNap"class="form-control"></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3"><label  class=" form-control-label">Hạn sử dụng:</label></div>
            <div class="col-12 col-md-9"><input type="date"  value="<?php echo $row['NgayHetHan']; ?>"name="NgayHetHan" class="form-control"></div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3"><label  class=" form-control-label">Hạn sử dụng sau mở nắp:</label></div>
            <div class="col-12 col-md-9"><input type="text" value="<?php echo $row['SoNgayHetHanSMN']; ?> Ngày" name="SoNgayHetHanSMN" class="form-control"></div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="luu"  >Lưu</button> 
            <button type="reset" data-dismiss="modal">Thoát</button>
          </div>
          
        </form>

      </div>
      
    </div>
  </div>
</div>
<?php } ?>

<?php
if (!isset($_GET["btn_search"]))
{
  ?>
  <script >
    (function($){
      function fetch_data()
      {
        $.ajax({
          url:"select.php",
          method:"POST",
          dataType:"json",
          success:function(data)
          {
            var html = '';
            for(var count = 0; count < data.length; count++)
            {
              var ngayhethan = new Date(data[count].NgayHetHan);
              var ngayhhmn = new Date (data[count].NgayMoNap);
              var hh = new Number(data[count].SoNgayHetHanSMN);
              if (!isNaN(ngayhhmn))
              {
                ngayhhmn.setDate(ngayhhmn.getDate()+hh.valueOf());
              }
              var dateNow = new Date(Date.now());
              if(isNaN(ngayhethan) && isNaN(ngayhhmn))
              {
                html += '<tr>';
                html += '<td><a data-toggle="modal" href="sua-vat-tu.php?id='+data[count].id+'" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
                html += '<td>'+data[count].MaVatTu+'</td>';
                html += '<td>'+data[count].TenHoaChat+'</td>';
  // html += '<td>'+data[count].CongThucHoaHoc+'</td>';
  html += '<td>'+data[count].SLT+'</td>';
  html += '<td>'+data[count].DVT+'</td>';
  // html += '<td>'+data[count].NguyHiemChinh+'</td>';
  // html += '<td>'+data[count].ChuY+'</td>';
  html += '<td>'+data[count].ViTriDat+'</td>';
  html += '<td>'+data[count].NgayMoNap+'</td>';
  html += '<td>'+data[count].NgayHetHan+'</td>';
  // html += '<td>'+data[count].NoiBaoQuan+'</td>';
  // html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
  // html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
  html += '</tr>';
}
else
{
  if (ngayhethan < dateNow )
  {
    html += '<tr title="ĐÃ HẾT HẠN SỬ DỤNG" id="trcss"style="background-color:#f900188f">';
    html += '<td><a data-toggle="modal" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
      html += '<td>'+data[count].MaVatTu+'</td>';
    html += '<td>'+data[count].TenHoaChat+'</td>';
  // html += '<td>'+data[count].CongThucHoaHoc+'</td>';
  html += '<td>'+data[count].SLT+'</td>';
  html += '<td>'+data[count].DVT+'</td>';
  // html += '<td>'+data[count].NguyHiemChinh+'</td>';
  // html += '<td>'+data[count].ChuY+'</td>';
  html += '<td>'+data[count].ViTriDat+'</td>';
  html += '<td>'+data[count].NgayMoNap+'</td>';
  html += '<td>'+data[count].NgayHetHan+'</td>';
  // html += '<td>'+data[count].NoiBaoQuan+'</td>';
  // html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
  // html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
  html += '</tr>';

}
 else if ( ngayhhmn < dateNow )
 {
   html += '<tr title="QUÁ THỜI HẠN CÓ THỂ SỬ DỤNG SAU MỞ NẮP" id="trcss"style="background-color:yellow">';
    html += '<td><a data-toggle="modal" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
      html += '<td>'+data[count].MaVatTu+'</td>';
    html += '<td>'+data[count].TenHoaChat+'</td>';
  // html += '<td>'+data[count].CongThucHoaHoc+'</td>';
  html += '<td>'+data[count].SLT+'</td>';
  html += '<td>'+data[count].DVT+'</td>';
  // html += '<td>'+data[count].NguyHiemChinh+'</td>';
  // html += '<td>'+data[count].ChuY+'</td>';
  html += '<td>'+data[count].ViTriDat+'</td>';
  html += '<td>'+data[count].NgayMoNap+'</td>';
  html += '<td>'+data[count].NgayHetHan+'</td>';
  // html += '<td>'+data[count].NoiBaoQuan+'</td>';
  // html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
  // html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
  html += '</tr>';
 }
else
{
  html += '<tr>';
  html += '<td><a data-toggle="modal" href="sua-vat-tu.php?id='+data[count].id+'" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
  html += '<td>'+data[count].MaVatTu+'</td>';
  html += '<td>'+data[count].TenHoaChat+'</td>';
  // html += '<td>'+data[count].CongThucHoaHoc+'</td>';
  html += '<td>'+data[count].SLT+'</td>';
  html += '<td>'+data[count].DVT+'</td>';
  // html += '<td>'+data[count].NguyHiemChinh+'</td>';
  // html += '<td>'+data[count].ChuY+'</td>';
  html += '<td>'+data[count].ViTriDat+'</td>';
  html += '<td>'+data[count].NgayMoNap+'</td>';
  html += '<td>'+data[count].NgayHetHan+'</td>';
  // html += '<td>'+data[count].NoiBaoQuan+'</td>';
  // html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
  // html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
  html += '</tr>';
}
}

}
$('tbody').html(html);
}
});
      }
      fetch_data();
    })(jQuery);
  </script>
  <?php
}
else
{
  ?>
  <script >
    (function($){
      function fetch_data()
      {
        $.ajax({
          url:'searchselect.php?searchString=<?php echo $_GET['btn_search']; ?>',
          method:"POST",
          dataType:"json",
          success:function(data)
          {
            var html = '';
            for(var count = 0; count < data.length; count++)
            {
              var ngayhethan = new Date(data[count].NgayHetHan);
              var ngayhhmn = new Date (data[count].NgayMoNap);
              var hh = new Number(data[count].SoNgayHetHanSMN);
              if (!isNaN(ngayhhmn))
              {
                ngayhhmn.setDate(ngayhhmn.getDate()+hh.valueOf());
              }
              var dateNow = new Date(Date.now());
              if(isNaN(ngayhethan) && isNaN(ngayhhmn))
              {
                html += '<tr>';
                html += '<td><a data-toggle="modal" href="sua-vat-tu.php?id='+data[count].id+'" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
                html += '<td>'+data[count].MaVatTu+'</td>';
                html += '<td>'+data[count].TenHoaChat+'</td>';
  // html += '<td>'+data[count].CongThucHoaHoc+'</td>';
  html += '<td>'+data[count].SLT+'</td>';
  html += '<td>'+data[count].DVT+'</td>';
  // html += '<td>'+data[count].NguyHiemChinh+'</td>';
  // html += '<td>'+data[count].ChuY+'</td>';
  html += '<td>'+data[count].ViTriDat+'</td>';
  html += '<td>'+data[count].NgayMoNap+'</td>';
  html += '<td>'+data[count].NgayHetHan+'</td>';
  // html += '<td>'+data[count].NoiBaoQuan+'</td>';
  // html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
  // html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
  html += '</tr>';
}
else
{
   if (ngayhethan < dateNow )
  {
    html += '<tr title="ĐÃ HẾT HẠN SỬ DỤNG" id="trcss"style="background-color:#f900188f">';
    html += '<td><a data-toggle="modal" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
      html += '<td>'+data[count].MaVatTu+'</td>';
    html += '<td>'+data[count].TenHoaChat+'</td>';
  // html += '<td>'+data[count].CongThucHoaHoc+'</td>';
  html += '<td>'+data[count].SLT+'</td>';
  html += '<td>'+data[count].DVT+'</td>';
  // html += '<td>'+data[count].NguyHiemChinh+'</td>';
  // html += '<td>'+data[count].ChuY+'</td>';
  html += '<td>'+data[count].ViTriDat+'</td>';
  html += '<td>'+data[count].NgayMoNap+'</td>';
  html += '<td>'+data[count].NgayHetHan+'</td>';
  // html += '<td>'+data[count].NoiBaoQuan+'</td>';
  // html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
  // html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
  html += '</tr>';

}
 else if ( ngayhhmn < dateNow )
 {
   html += '<tr title="QUÁ THỜI HẠN CÓ THỂ SỬ DỤNG SAU MỞ NẮP" id="trcss"style="background-color:yellow">';
    html += '<td><a data-toggle="modal" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
      html += '<td>'+data[count].MaVatTu+'</td>';
    html += '<td>'+data[count].TenHoaChat+'</td>';
  // html += '<td>'+data[count].CongThucHoaHoc+'</td>';
  html += '<td>'+data[count].SLT+'</td>';
  html += '<td>'+data[count].DVT+'</td>';
  // html += '<td>'+data[count].NguyHiemChinh+'</td>';
  // html += '<td>'+data[count].ChuY+'</td>';
  html += '<td>'+data[count].ViTriDat+'</td>';
  html += '<td>'+data[count].NgayMoNap+'</td>';
  html += '<td>'+data[count].NgayHetHan+'</td>';
  // html += '<td>'+data[count].NoiBaoQuan+'</td>';
  // html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
  // html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
  html += '</tr>';
 }
else
{
  html += '<tr>'; 
  html += '<td><a data-toggle="modal" href="sua-vat-tu.php?id='+data[count].id+'" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
  html += '<td>'+data[count].MaVatTu+'</td>';
  html += '<td>'+data[count].TenHoaChat+'</td>';
  // html += '<td>'+data[count].CongThucHoaHoc+'</td>';
  html += '<td>'+data[count].SLT+'</td>';
  html += '<td>'+data[count].DVT+'</td>';
  // html += '<td>'+data[count].NguyHiemChinh+'</td>';
  // html += '<td>'+data[count].ChuY+'</td>';
  html += '<td>'+data[count].ViTriDat+'</td>';
  html += '<td>'+data[count].NgayMoNap+'</td>';
  html += '<td>'+data[count].NgayHetHan+'</td>';
  // html += '<td>'+data[count].NoiBaoQuan+'</td>';
  // html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
  // html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
  html += '</tr>';
}
}
}
$('tbody').html(html);
}
});
      }
      fetch_data();
    })(jQuery);
  </script>
<?php }
?>
<!-- <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script> -->
<script type="text/javascript">
  $('.modal-content').resizable({
//alsoResize: ".modal-dialog",
minHeight: 1000,
minWidth: 1000
});
  $('.modal-dialog').draggable();
  $('#xemthongtin').on('show.bs.modal', function() {
    $(this).find('.modal-body').css({
      'max-height': '120%'
    });
  });
</script>
<script>
  $(function() {
    $("#skill_input").autocomplete({
      source: "chemistry_name.php",
    });
  });
</script>
<?php include 'scriptindex.php'; ?>
<!-----===============================================SCRIPT===============================================--->
<!-- <script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script> -->
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<!-- <script src="vendors/jszip/dist/jszip.min.js"></script>
<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="vendors/pdfmake/build/vfs_fonts.js"></script> -->
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
<!-----====================================================================================================--->
</body>
</html>