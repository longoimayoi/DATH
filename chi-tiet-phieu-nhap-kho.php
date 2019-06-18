<?php include 'header.php'; ?>
<body>

  <?php include 'leftpanel.php';
 $id = $_GET["id"]; 
  $query_c="SELECT COUNT(TenVT) as TVT FROM  ctphieunhapkho WHERE MaPhieu=$id ";
$result_c=mysqli_query($connect,$query_c);
list($TVT)=mysqli_fetch_array($result_c,MYSQLI_NUM);

 
  if(isset($_POST['import']))
  {
    $data=array();
    if($_FILES['file']['tmp_name'])
    {
      $dom = DOMDocument::load($_FILES['file']['tmp_name']);
      $rows = $dom->getElementsByTagName('Row');
      $first_row = true;
      foreach ($rows as $row)
      {
        if(!$first_row)
        {
          $index = 1;
          $cells = $row->getElementsByTagName('Cell');
          foreach ($cells as $cell)
          {
            $ind = $cell->getAttribute('Index');
            if($ind != null) $index = $ind;
            if($index == 1)
              $tenvattu = $cell->nodeValue;
            if($index == 2)
              $dvt = $cell->nodeValue;
            if($index == 3)
              $sl = $cell->nodeValue;
            if($index == 4)
              $thongso = $cell->nodeValue;
            if($index == 5)
              $xuatxu = $cell->nodeValue;
            if($index == 6)
              $ghichu = $cell->nodeValue;
            $index++;
          }
          $data[]=array(
            'TenVatTu' =>$tenvattu,
            'DVT'  =>$dvt,
            'SL'  =>$sl,
            'ThongSoKT'  =>$thongso,
            'XuatXu'  =>$xuatxu,
            'GhiChu'  =>$ghichu
          );
        }
        $first_row = false;
      }
    }
    if($data)
    {
      $dem_tt=1;
      foreach ($data as $row)
      {
        if($dem_tt>1)
        {
          $a1=$row['TenVatTu'];
          $a2=$row['DVT'];
          $a3=$row['SL'];
          $a4=$row['ThongSoKT'];
          $a5=$row['XuatXu'];
          $a6=$row['GhiChu'];
          $query="INSERT INTO ctphieunhapkho(MaPhieu,TenVT,DVT,SL,ThongSoKT,XuatXu,GhiChu)
          VALUES($id,'{$a1}','{$a2}',$a3,'$a4','$a5','$a6')";
          $results=mysqli_query($connect,$query);
        }
        $dem_tt++;
      }
      echo "<script>alert('Import thành công')</script>";
          echo("<script>location.href = '"."chi-tiet-phieu-nhap-kho.php?id=$id';</script>");
    }
  }
  ?>
  <div class="content mt-3">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <strong>CHI TIẾT PHIẾU NHẬP KHO</strong>
        </div>
        <div class="card-body card-block">
          <div class="row">
            <div class="col-6">
              <?php
              
              $sql = "SELECT TenDangNhap, NgayLapPhieu, GhiChu FROM tbl_phieunhapkho pnk, tbltaikhoan tk WHERE pnk.NguoiLap = tk.MaTK and  MaPhieu =" . $id;
              $query = mysqli_query($connect, $sql);
              $row = mysqli_fetch_assoc ($query);
              ?>
              <div class="form-group">
                <label for="cc-exp" class="control-label mb-1">Người lập phiếu</label>
                <div class="input-group">
                  
                  <input style="background-color: #d0d0d03b" type="text" id="input1-group1" name="input1-group1" disabled="" value="<?php echo $row["TenDangNhap"] ?>" class="form-control"><div class="input-group-addon"><i class="ti-user"></i></div>
                </div>
              </div>
            </div>
            
            <div class="col-6">
              <div class="form-group">
                <label for="cc-exp" class="control-label mb-1">Ngày lập phiếu</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="ti-timer"></i></div>
                  <input style="background-color: #d0d0d03b" disabled="" value="<?php echo $row["NgayLapPhieu"] ?>"type="text" id="input1-group1" name="input1-group1" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <?php if ($row["GhiChu"] != null) { ?>
            <div class="col-12">
              <div class="form-group">
                <label for="cc-exp" class="control-label mb-1">Ghi chú</label>
                <div class="input-group">
                  <textarea style="background-color: #d0d0d03b"class="form-control" disabled=""  rows="2"><?php echo $row["GhiChu"] ?></textarea>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!----============================HẾT BẢNG CHI TIẾT -> BẢNG THÔNG TIN NHẬP=====================================---->
  <div class="content mt-3">
    <div class="col-lg-12">
      <div class="row">
        <?php
        $sqlTT = "SELECT TrangThai FROM tbl_phieunhapkho WHERE MaPhieu = ".$id;
        $queryTT = mysqli_query($connect, $sqlTT);
        $row = mysqli_fetch_array($queryTT);
        $status = $row[0];
        if ($status == 0)
        {
        ?>
        <div class="col-sm-3">
          <div class="card-body text-secondary">
            <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">Thêm vật tư</button>
          </div>
        </div>
        <?php } ?>
        <div class="col">
          <button style="display: none">X</button>
        </div>
        <div style="margin-right: 14px">
          <div style="display: flex" class="card-body text-secondary"><?php if ($status == 0)
            { ?>
              <div>
            <form action="" method="post" enctype="multipart/form-data">
            <button for="file-upload" style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"> Chọn</i> </button>
            <input id="file-upload" type="file" name="file" multiple style='display: none;'>
            <button type="submit" name="import">Nhập excel</button> 
            </form>
            </div>
            <?php } if($TVT >0) {?>
            <div>
          <a  href="export-chi-tiet-phieu-nhap-kho.php?id=<?php echo $id ?>"><button type="submit" class="callback"  name="import">Xuất excel</button> </a>
          </div>
        <?php } ?>
        </div>
      </div>
      <?php
      if(isset($_POST['submit']))
      {
      $tenvt=$_POST['tenvt'];
      $sl=$_POST['sl'];
      $dvtinh=$_POST['dvtinh'];
      $thongso=$_POST['thongso'];
      $xuatxu=$_POST['xuatxu'];
      $ghichu=$_POST['ghichu'];
      if($sl < 0)
      {
      echo "<script>alert('Số lượng phải lớn hơn 0')</script>";
      }
      else if(is_numeric($dvtinh))
      {
      echo "<script>alert('Đơn vị tính phải là kiểu chuỗi')</script>";
      }
      else
      {
      foreach ($tenvt as $k => $v)
      {
      $query="INSERT INTO ctphieunhapkho(MaPhieu,TenVT,DVT,SL,ThongSoKT,XuatXu,GhiChu) VALUES
      ($id,'$v','$dvtinh[$k]','$sl[$k]','$thongso[$k]','$xuatxu[$k]','$ghichu[$k]')";
      $result=mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
      }
      if(mysqli_affected_rows($connect)==1)
      {
      echo "<script>alert('Thêm chi tiết thành công')</script>";
      echo("<script>location.href = '"."chi-tiet-phieu-nhap-kho.php?id=$id';</script>");
      }
      else
      {
      echo "<script>alert('Lập phiếu không thành công')</script>";
      }
      }
      }
      ?>
      <div id="collapse1" class="col-lg-12 panel-collapse collapse">
        <div class="card" >
          <div class="card-header">
            <strong>Nhập kho</strong>
          </div >
          <div class="card-body card-block" style="background-color:#f1f2f7">
            <form action="" method="post" class="">
              <div class="wrapper">
                <div  style="display: flex;">
                  <div style="width: 90%;" id="lbform" class="form-control-label">
                    <label  class="form-control-label">Tên vật tư</label>
                  </div>
                  <div style="width: 90%;"id="lbform" class="form-control-label">
                    <label class="form-control-label">Đơn vị tính </label>
                  </div>
                  <div style="width: 90%;" id="lbform" class="form-control-label">
                    <label class="form-control-label">Số lượng</label>
                  </div>
                  <div style="width: 90%;"id="lbform" class="form-control-label">
                    <label class="form-control-label">Thông số kỹ thuật</label>
                  </div>
                  <div style="width: 90%;"id="lbform" class="form-control-label">
                    <label class="form-control-label">Xuất xứ</label>
                  </div>
                  <div style="width: 90%;"id="lbform" class="form-control-label">
                    <label class="form-control-label">Ghi chú</label>
                  </div>
                  <div style="width: 178px;"id="lbempty" class="form-control-label">
                    <label class="form-control-label"></label>
                  </div>
                </div>
                <div  style="display: flex;">
                  <div style="width: 110%"class="form-group">
                    <input type="text" id = "skill_input" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư"class="form-control" required autocomplete="off">
                  </div>
                  <div style="width: 110%"class="form-group">
                    <input type="text" value="" name="dvtinh[]" placeholder="Đơn vị tính"class="form-control" required>
                  </div>
                  <div style="width: 110%"class="form-group">
                    <input type="number" value="" name="sl[]" placeholder="Số lượng "class="form-control" required>
                  </div>
                  <div style="width: 110%"class="form-group">
                    <input type="text" value="" name="thongso[]" placeholder="Thông số kỹ thuật"class="form-control" >
                  </div>
                  <div style="width: 110%"class="form-group">
                    <input type="text" value="" name="xuatxu[]" placeholder="Xuất xứ"class="form-control" >
                  </div>
                  <div style="width: 110%"class="form-group">
                    <input type="text" value="" name="ghichu[]" placeholder="Ghi chú"class="form-control">
                  </div>
                  <div class="form-group">
                    <div id="add_fields" class="add_fields input-group-addon"><i class="fa fa-plus-square"></i></div>
                  </div>
                </div>
              </div>
              <div id="row" >
                <div class="submit" style="float: right;margin-right: 1px">
                  <button type="submit" name="submit" >
                  Lưu
                  </button>
                  <button type="reset" >
                  Đặt lại
                  </button>
                </div>
              </div>
              <br>
            </form>
          </div>
        </div>
      </div>
      <?php
      $sqlct = "SELECT * FROM ctphieunhapkho WHERE MaPhieu=".$id;
      $queryct = mysqli_query($connect, $sqlct);
      $count = mysqli_num_rows($queryct);
      if ($count > 0)
      {
      ?>
      <div class="col-lg-12">
        <div class="card">
          <form method="post" id="update_form">
            <div class="card-header">
              <strong style="position: relative;" class="card-title">DANH SÁCH VẬT TƯ NHẬP KHO</strong>
              <?php
              if ($status == 0)
              {
              ?>
              <div style="margin-top: -28px; position: absolute;">
                <button style="width: 60px" class="cusbtn1"title="Lưu vật tư" type="submit" id="submit"><span style="margin-left: -6px"class="ti-save"></span></button>
                &nbsp
                <button style="width: 60px"class="cusbtn2"title="Xóa vật tư" type="reset" id ="delete"><span  style="margin-left: -6px"class="ti-trash"></span></button>
              </div>
              <?php } ?>
              <!--  -->
            </div>
            <!--    <form method="post" id="update_form"> -->
            <br />
            <div class="card-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <th></th>
                  <th width="20%">Tên Vật tư</th>
                  <th width="10%">Đơn vị tính</th>
                  <th width="10%">Số lượng</th>
                  <th width="20%">Thông số KT</th>
                  <th width="20%">Xuất xứ</th>
                  <th width="20%">Ghi chú</th>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </form>
          <!--        <form method = "post">
            <input type="submit" name = "delete" style="background-color: #ff0000d6" value="Hủy phiếu"/>
          </form> -->
          <?php
          if (isset($_POST['xoaPhieu']))
          {
          $sqlDelete = "DELETE FROM tbl_phieunhapkho WHERE MaPhieu=".$id;
          $sqlDeleteDetail = "DELETE FROM ctphieunhapkho WHERE MaPhieu=".$id;
          $queryDelete = mysqli_query($connect, $sqlDelete);
          $queryDeleteDetail = mysqli_query($connect, $sqlDeleteDetail);
          echo("<script>location.href = '"."danh-sach-phieu-nhap-kho.php';</script>");
          }
          if (isset($_POST['lapPhieu']))
          {
          $sql = "SELECT * FROM ctphieunhapkho WHERE  MaPhieu='$id'  ";
          $query = mysqli_query($connect, $sql);
          $arr = array();
          $arrayPhieu = array();
          while ($row = mysqli_fetch_assoc($query))
          {
          array_push($arr, $row['TenVT']);
          $arrayPhieu[$row['TenVT']]=$row['SL'];
          }
          $arraytk = array();
          foreach($arr as $tvt)
          {
          $sqltk = "SELECT * FROM tblhoachat WHERE TenHoaChat in (SELECT TenVT from ctphieunhapkho where MaPhieu='$id'  and TenVT = '$tvt' )  ";
          $querytk = mysqli_query($connect, $sqltk);
          while ($rowtk = mysqli_fetch_assoc($querytk))
          {
          $arraytk[$rowtk['TenHoaChat']]=$rowtk['SLT'];
          }
          }
          
          foreach ($arrayPhieu as $keyPhieu => $valuePhieu) {
          $count = 0;
          foreach ($arraytk as $keytk => $valuetk) {
          if ($keyPhieu == $keytk)
          {
          $sl = $valuePhieu + $valuetk;
          $sqlUpdate = "UPDATE tblhoachat SET  SLT = '$sl' WHERE TenHoaChat = '$keytk' ";
          $queryUpdate = mysqli_query($connect, $sqlUpdate);
          $count ++;
          break;
          }
          }
          if ($count == 0)
          {
          $sqlInsert="INSERT INTO tblhoachat (TenHoaChat,SLT)
          VALUES('{$keyPhieu}','{$valuePhieu}')";
          $queryInsert=mysqli_query($connect,$sqlInsert);
          }
          }
          $sqlTTP = "UPDATE tbl_phieunhapkho SET  TrangThai = 1 WHERE MaPhieu = '$id' ";
          $queryTTP = mysqli_query($connect, $sqlTTP);
          echo("<script>location.href = '"."danh-sach-phieu-nhap-kho.php';</script>");
          }
          ?>
          <?php if ($status == 0)
          { ?>
          <form method="post" >
            <div id="row" >
              <div class="col-md-6 offset-md-3">
                <section style="border:none"class="card">
                  <div class="submit" style="margin:0 auto" >
                    <button type="submit" name="lapPhieu" >
                    Tiến hành nhập kho
                    </button>
                    
                    <button type="submit" name ="xoaPhieu" style="background-color:red" >
                    Hủy phiếu
                    </button>
                  </div>
                </section>
              </div>
              
            </div>
          </form>
          <?php } ?>
          
          <?php }
          else
          {
          ?>
          <?php
          }
          ?>
        </div>
        <!-----===============================================SCRIPT===============================================--->
        <script >
        (function($){
        function fetch_data()
        {
        $.ajax({
        url:"dataNhapKho.php?id=<?php echo $id ?>",
        method:"GET",
        dataType:"json",
        success:function(data)
        {
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
        html += '<tr>';
          html += '<td><input type="checkbox" STT="'+data[count].STT+'"data-TenVT="'+data[count].TenVT+'" data-DVT="'+data[count].DVT+'" data-SL="'+data[count].SL+'" data-ThongSoKT="'+data[count].ThongSoKT+'" data-XuatXu="'+data[count].XuatXu+'"data-GhiChu="'+data[count].GhiChu+'" class="check_box"  /></td>';
          html += '<td>'+data[count].TenVT+'</td>';
          html += '<td>'+data[count].DVT+'</td>';
          html += '<td>'+data[count].SL+'</td>';
          html += '<td>'+data[count].ThongSoKT+'</td>';
          html += '<td>'+data[count].XuatXu+'</td>';
          html += '<td>'+data[count].GhiChu+'</td></tr>';
          }
          $('tbody').html(html);
          }
          });
          }
          fetch_data();
          $(document).on('click', '.check_box', function(){
          var html = '';
          if(this.checked)
          {
          html = '<td><input type="checkbox" STT="'+$(this).attr('stt')+'" data-TenVT="'+$(this).data('tenvt')+'" data-DVT="'+$(this).data('dvt')+'" data-SL="'+$(this).data('sl')+'" data-ThongSoKT="'+$(this).data('thongsokt')+'" data-XuatXu="'+$(this).data('xuatxu')+'" data-GhiChu="'+$(this).data('ghichu')+'" class="check_box" checked /></td>';
          html += '<td><input type="text" id = "skill_input" name="TenVatTu[]" class="form-control" value="'+$(this).data("tenvt")+'" autocomplete = "off"/></td>';
          html += '<td><input type="text" name="DVT[]" class="form-control" value="'+$(this).data("dvt")+'" /></td>';
          html += '<td><input  type="text" name="SL[]" class="form-control" value="'+$(this).data("sl")+'" /></td>';
          html += '<td><input type="text" name="ThongSoKT[]" class="form-control" value="'+$(this).data("thongsokt")+'" /></td>';
          html += '<td><input  type="text" name="XuatXu[]" class="form-control" value="'+$(this).data("xuatxu")+'" /></td>';
          html += '<td><input type="text" name="GhiChu[]" class="form-control" value="'+$(this).data("ghichu")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('stt')+'" /></td>';
          }
          else
          {
          html = '<td><input type="checkbox" STT="'+$(this).attr('stt')+'" data-TenVT="'+$(this).data('tenvt')+'" data-DVT="'+$(this).data('dvt')+'" data-SL="'+$(this).data('sl')+'" data-ThongSoKT="'+$(this).data('thongsokt')+'" data-XuatXu="'+$(this).data('xuatxu')+'" data-GhiChu="'+$(this).data('ghichu')+'" class="check_box" /></td>';
          html += '<td>'+$(this).data('tenvt')+'</td>';
          html += '<td>'+$(this).data('dvt')+'</td>';
          html += '<td>'+$(this).data('sl')+'</td>';
          html += '<td>'+$(this).data('thongsokt')+'</td>';
          html += '<td>'+$(this).data('xuatxu')+'</td>';
          html += '<td>'+$(this).data('ghichu')+'</td>';
          }
          $(this).closest('tr').html(html);
          })  ;
          $('#update_form').on('submit',function(event){
          if (confirm("Xác nhận lưu dữ liệu !"))
          {
          event.preventDefault();
          if($('.check_box:checked').length > 0)
          {
          $.ajax({
          url:"saveDataNhapKho.php",
          method:"POST",
          data:$(this).serialize(),
          success:function()
          {
          alert('Cập nhật dữ liệu thành công !');
          fetch_data();
          }
          })
          }
          }
          });
          $('#update_form').on('reset',function(event){
          if (confirm("Xác nhận xóa dữ liệu !"))
          {
          event.preventDefault();
          if($('.check_box:checked').length > 0)
          {
          $.ajax({
          url:"deleteDataNhapKho.php",
          method:"POST",
          data:$(this).serialize(),
          success:function()
          {
          alert('Cập nhật dữ liệu thành công !');
          fetch_data();
          }
          })
          }
          }
          });
          })(jQuery);
          </script>
          <script>
          $('.addfiles').on('click', function() { $('#file-upload').click();return false;});
          </script>
          <script>
          //Add Input Fields
          (function($) {
          var max_fields = 20; //Maximum allowed input fields
          var wrapper    = $(".wrapper"); //Input fields wrapper
          var add_button = $("#add_fields"); //Add button class or ID
          var x = 1; //Initial input field is set to 1
          //When user click on add input button
          $(add_button).click(function(e){
          e.preventDefault();
          //Check maximum allowed input fields
          if(x < max_fields){
          x++;
          var selectPattern = $('#catalog-pattern').clone().html();
          $(wrapper).append('<div> <div  style="display: flex;"> <div style="width: 110%"class="form-group"><input id = "skill_input" type="text" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư"class="form-control" required autocomplete="off"> </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="dvtinh[]" placeholder="Đơn vị tính"class="form-control" required> </div>  <div style="width: 110%"class="form-group"> <input type="number" value="" name="sl[]" placeholder="Số lượng "class="form-control" required> </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="thongso[]" placeholder="Thông số kỹ thuật"class="form-control" >  </div> <div style="width: 110%"class="form-group">  <input type="text" value="" name="xuatxu[]" placeholder="Xuất xứ"class="form-control" > </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="ghichu[]" placeholder="Ghi chú"class="form-control">  </div>  <a href="javascript:void(0);" class="remove_field"><div class="input-group-addon"><i class="fa fa-minus-square"></i></div></a></div></div>');
          }
          });
          //when user click on remove button
          $(wrapper).on("click",".remove_field", function(e){
          e.preventDefault();
          $(this).parent('div').remove(); //remove inout field
          x--;
          })
          })(jQuery);
          </script>
          <script type="text/javascript">
          $(document).ready(function(){
          $('input[type="file"]').change(function(e){
          var fileName = e.target.files[0].name;
          $(this).prev('button').text(fileName);
          });
          });
          </script>
   
          <script src="vendors/jquery/dist/jquery.min.js"></script>
          <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
          <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
          <script src="assets/js/main.js"></script>
          <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
          <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
          <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
          <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
          <script src="vendors/jszip/dist/jszip.min.js"></script>
          <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
          <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
          <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
          <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
          <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
          <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
          <!-----====================================================================================================--->
        </body>