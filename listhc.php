<?php include 'header.php'; ?>
<body>
  <?php include 'leftpanel.php' ; ?>
  <div class="content mt-3">
    <div class="animated fadeIn">
      <!-- <div class="table-responsive"> -->
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
      <!--  <form method="post"> -->

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">DANH SÁCH VẬT TƯ</strong>
          </div>
          <div class="card-body" >
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
              <thead>
                <th width="1%"></th>
                <th width="15%">Tên Vật Tư</th>
                <!-- <th width="10%">Công thức</th> -->
                <th width="10%">Số lượng tồn</th>
                <th width="10%">Đơn vị tính</th>
                <!--   <th width="25%">Nguy hiểm chính</th> -->
                <!--       <th width="10%">Chú ý</th> -->
                <th width="10%"title="Vị trí đặt">Vị trí đặt</th>
                <th width="8%">Ngày mở</th>
                <th width="15%">Hạn sử dụng</th>
                <!--     <th width="15%">Yêu cầu khi sử dụng</th> -->
              </thead>
            <tbody></tbody>
          </table>
        </div>
        <!-- </form> -->
        <!--   </div> -->
      </div>
    </div>
      <?php $query="SELECT * FROM tblhoachat Order By id";
      $result = mysqli_query($connect, $query);
      $arr = array();
      while ($rowAll=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
      array_push($arr, $rowAll['id']);
      }
      ?>
      <?php foreach ($arr as $id)  {
      $queryDetail="SELECT * FROM tblhoachat where id = ".$id;
      $resultDetail = mysqli_query($connect, $queryDetail);
      while ($row=mysqli_fetch_array($resultDetail,MYSQLI_ASSOC))
      {
      ?>
      <div class="modal fade" id="xemthongtin<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="max-width: 800px!important;" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form >
                
                <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Tên hóa chất:</label></div>
                  <div class="col-12 col-md-9">
                    <p class="form-control-static"><?php echo $row['TenHoaChat']; ?></p>
                  </div>
                </div>
                <!--   <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Công thức hóa học:</label></div>
                  <div class="col-12 col-md-9"><input type="text" name="text-input" value="<?php echo $row['CongThucHoaHoc']; ?>"class="form-control"></div>
                </div> -->
                <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Số lượng tồn:</label></div>
                  <div class="col-12 col-md-9"><input type="text"  value="<?php echo $row['SLT']; ?>"name="email-input"class="form-control"></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label  class=" form-control-label">Đơn vị tính:</label></div>
                  <div class="col-12 col-md-9"><input type="text"  value="<?php echo $row['DVT']; ?>"name="password-input" class="form-control"></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label  class=" form-control-label">Vị trí đặt:</label></div>
                  <div class="col-12 col-md-9"><input type="text" value="<?php echo $row['ViTriDat']; ?>" name="password-input" class="form-control"></div>
                </div>
                <!--  <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Nguy hiểm chính:</label></div>
                  <div class="col-12 col-md-9"><textarea name="textarea-input"  rows="3"class="form-control"><?php echo $row['NguyHiemChinh']; ?></textarea></div>
                </div> -->
                <!--         <div class="row form-group">
                  <div class="col col-md-3"><label  class=" form-control-label">Chú ý:</label></div>
                  <div class="col-12 col-md-9"><textarea name="textarea-input" rows="3"class="form-control"><?php echo $row['ChuY']; ?></textarea></div>
                </div> -->
                <!--           <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Nơi bảo quản:</label></div>
                  <div class="col-12 col-md-9"><textarea name="textarea-input"  rows="3"class="form-control"><?php echo $row['NoiBaoQuan']; ?></textarea></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Điều kiện bảo quản:</label></div>
                  <div class="col-12 col-md-9"><textarea name="textarea-input" rows="3"class="form-control"><?php echo $row['DieuKienBaoQuan']; ?></textarea></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label  class=" form-control-label">Yêu cầu khi sử dụng:</label></div>
                  <div class="col-12 col-md-9"><textarea name="textarea-input"rows="3"class="form-control"><?php echo $row['YeuCauKhiSuDung']; ?></textarea></div>
                </div> -->
                <div class="row form-group">
                  <div class="col col-md-3"><label class=" form-control-label">Ngày mở:</label></div>
                  <div class="col-12 col-md-9"><input type="text"  value="<?php echo $row['NgayMoNap']; ?>"name="email-input"class="form-control"></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label  class=" form-control-label">Hạn sử dụng:</label></div>
                  <div class="col-12 col-md-9"><input type="text"  value="<?php echo $row['NgayHetHan']; ?>"name="password-input" class="form-control"></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label  class=" form-control-label">Hạn sử dụng khi mở nắp:</label></div>
                  <div class="col-12 col-md-9"><input type="text" value="<?php echo $row['SoNgayHetHanSMN']; ?>" name="password-input" class="form-control"></div>
                </div>
                <div class="modal-footer">
                  <button type="reset" data-dismiss="modal">Close</button>
                  <button type="submit" >Save changes</button>
                </div>
                
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <?php } ?>
      <?php } ?>
      <?php
      if (!isset($_GET["btn_search"]))
      {
      ?>
      <script >
      $(document).ready(function(){
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
      ngayhhmn.setDate(ngayhhmn.getDate()+hh.valueOf());
      var dateNow = new Date(Date.now());
      if (ngayhethan < dateNow || ngayhhmn < dateNow)
      {
      html += '<tr style="background-color:#f900188f">';
        html += '<td><a data-toggle="modal" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
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
        html += '<td><a data-toggle="modal" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
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
      $(document).ready(function(){
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
      html += '<tr>';
        html += '<td><a data-toggle="modal" data-target="#xemthongtin'+ data[count].id+'" class="ti-eye"></a></td>';
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
      $('tbody').html(html);
      }
      });
      }
      fetch_data();
      })(jQuery);
      </script>
      <?php }
      ?>
      <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
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