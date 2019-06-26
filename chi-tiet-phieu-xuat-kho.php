<?php include 'header.php'; ?>
<body>
  <?php include 'leftpanel.php' ;
  $id = $_GET["id"];
    $query_c="SELECT COUNT(TenVT) as TVT FROM  ctphieuxuatkho WHERE MaPhieu=$id ";
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
              $sl = $cell->nodeValue;
            $index++;
          }
          $data[]=array(
            'TenVT' =>$tenvattu,
            'SL'  =>$sl,
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
          $a1=$row['TenVT'];
          $a2=$row['SL'];
          $query="INSERT INTO ctphieuxuatkho(MaPhieu,TenVT,SL)
          VALUES($id,'{$a1}','{$a2}')";
          $results=mysqli_query($connect,$query);
        }
        $dem_tt++;
      }
      echo "<script>alert('Import thành công')</script>";
      echo("<script>location.href = '"."chi-tiet-phieu-xuat-kho.php?id=$id';</script>");
    }
  }
  ?>
  <div class="content mt-3">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <strong>CHI TIẾT PHIẾU XUẤT KHO</strong>
        </div>
        <div class="card-body card-block">
          <!--  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> -->
            <div class="row">
              <div class="col-6">
                <?php

                $_SESSION["MaPhieuXuat"] = $id;
                unset($_SESSION['cart']);
                $sql = "SELECT TenDangNhap, NgayLapPhieu, GhiChu FROM tbl_phieuxuatkho pxk, tbltaikhoan tk WHERE pxk.NguoiLap = tk.MaTK and  MaPhieu =" . $id;
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
                      <!--   <input value="<?php echo $row["NgayLapPhieu"] ?>"type="text" id="input1-group1" name="input1-group1" class="form-control"> -->
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!----============================HẾT BẢNG CHI TIẾT -> BẢNG THÔNG TIN XUẤT=====================================---->
    <div class="content mt-3">
      <div class="col-lg-12">
        <div class="row">
          <?php
          $sqlTT = "SELECT TrangThai FROM tbl_phieuxuatkho WHERE MaPhieu = ".$id;
          $queryTT = mysqli_query($connect, $sqlTT);
          $row = mysqli_fetch_array($queryTT);
          $status = $row[0];
          if ($status == 0)
          {
            ?>
            <div class=".col">
              <!-- <div > -->
                <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346;margin-left: 15px" type="submit">Thêm vật tư</button>
                <a  href="chon-hoa-chat.php" ><button type="submit">Chọn từ kho</button></a>
                <!-- </div> -->
              </div>
            <?php } ?>
            <div class="col">

            </div>

            <?php if ($status == 0){ ?>
              <form style="margin-right: 3px"action="" method="post" enctype="multipart/form-data">
                <button for="file-upload" style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"> Chọn</i> </button>
                <input id="file-upload" type="file" name="file" multiple style='display: none;'>
                <button type="submit" name="import">Nhập excel</button>
              </form>
            <?php } if($TVT >0) {?>

            <div style="margin-right: 14px">
              <div>
               <a href="export-chi-tiet-phieu-xuat-kho.php?id=<?php echo $id ?>"><button type="submit" class="callback"  name="import">Xuất excel</button> </a>
             </div>
           </div>
         <?php } ?>
         </div>
         <hr style="display:inline-grid;">
       </div>
       <?php
       if(isset($_POST['submit']))
       {
        $tenvt=$_POST['tenvt'];
        $sl=$_POST['sl'];
    /* $dvtinh=$_POST['dvtinh'];
    $thongso=$_POST['thongso'];
    $xuatxu=$_POST['xuatxu'];
    $ghichu=$_POST['ghichu'];*/
    if($sl < 0)
    {
      echo "<script>alert('Số lượng phải lớn hơn 0')</script>";
    }
    /*  else if(is_numeric($dvtinh))
    {
    echo "<script>alert('Đơn vị tính phải là kiểu chuỗi')</script>";
  }*/
  else
  {
    foreach ($tenvt as $k => $v)
    {
      $query="INSERT INTO ctphieuxuatkho(MaPhieu,TenVT,SL) VALUES
      ($id,'$v','$sl[$k]')";
      $result=mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
    }
    if(mysqli_affected_rows($connect)==1)
    {
      /*echo "<script>alert('Thêm chi tiết thành công')</script>";*/
      echo("<script>location.href = '"."chi-tiet-phieu-xuat-kho.php?id=$id';</script>");
    }
    else
    {
      echo "<script>alert('Thêm chi tiết không thành công')</script>";
    }
  }
}
?>
<div id="collapse1" class="col-lg-12 panel-collapse collapse">
  <div class="card" >
    <div class="card-header">
      <strong>Xuất kho</strong>
    </div >
    <div class="card-body card-block" style="background-color:#f1f2f7">
      <form action="" method="post" class="">
        <div class="wrapper">
          <div  style="display: flex;">
            <div style="width: 100%;" id="lbform" class="form-control-label">
              <label  class="form-control-label">Tên vật tư</label>
            </div>
                <!--  <div style="width: 90%;"id="lbform" class="form-control-label">
                  <label class="form-control-label">Đơn vị tính </label>
                </div> -->
                <div style="width: 90%;" id="lbform" class="form-control-label">
                  <label class="form-control-label">Số lượng</label>
                </div>
                <!--  <div style="width: 90%;"id="lbform" class="form-control-label">
                  <label class="form-control-label">Thông số kỹ thuật</label>
                </div>
                <div style="width: 90%;"id="lbform" class="form-control-label">
                  <label class="form-control-label">Xuất xứ</label>
                </div>
                <div style="width: 90%;"id="lbform" class="form-control-label">
                  <label class="form-control-label">Ghi chú</label>
                </div> -->
                <div style="width: 178px;"id="lbempty" class="form-control-label">
                  <label class="form-control-label"></label>
                </div>
              </div>
              <div  style="display: flex;">
                <div style="width: 110%"class="form-group">
                  <input type="text" id = "skill_input" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư"class="form-control" required autocomplete = "off">
                </div>
                <!-- <div style="width: 110%"class="form-group">
                  <input type="text" value="" name="dvtinh[]" placeholder="Đơn vị tính"class="form-control" required>
                </div> -->
                <div style="width: 110%"class="form-group">
                  <input type="number" value="" name="sl[]" placeholder="Số lượng "class="form-control" required>
                </div>
                <!--  <div style="width: 110%"class="form-group">
                  <input type="text" value="" name="thongso[]" placeholder="Thông số kỹ thuật"class="form-control" >
                </div>
                <div style="width: 110%"class="form-group">
                  <input type="text" value="" name="xuatxu[]" placeholder="Xuất xứ"class="form-control" >
                </div>
                <div style="width: 110%"class="form-group">
                  <input type="text" value="" name="ghichu[]" placeholder="Ghi chú"class="form-control">
                </div> -->
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
    $sqlct = "SELECT * FROM ctphieuxuatkho WHERE MaPhieu=".$id;
    $queryct = mysqli_query($connect, $sqlct);
    $count = mysqli_num_rows($queryct);
    if ($count > 0)
    {
      ?>
      <div class="col-lg-12">
        <div class="card">
          <form method="post" id="update_form">
            <div class="card-header">
              <strong style="position: relative;" class="card-title">DANH SÁCH VẬT TƯ XUẤT KHO</strong>
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
                    <th width="1%"></th>
                    <th width="10%">Tên vật tư</th>
                    <th width="10%">Số lượng</th>
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
          $sqlDelete = "DELETE FROM tbl_phieuxuatkho WHERE MaPhieu=".$id;
          $sqlDeleteDetail = "DELETE FROM ctphieuxuatkho WHERE MaPhieu=".$id;
          $queryDelete = mysqli_query($connect, $sqlDelete);
          $queryDeleteDetail = mysqli_query($connect, $sqlDeleteDetail);
          echo("<script>location.href = '"."danh-sach-phieu-xuat-kho.php';</script>");
        }
        if (isset($_POST['lapPhieu']))
        {
          $sql = "SELECT * FROM ctphieuxuatkho WHERE  MaPhieu='$id'  ";
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
            $sqltk = "SELECT * FROM tblhoachat WHERE TenHoaChat in (SELECT TenVT from ctphieuxuatkho where MaPhieu='$id'  and TenVT = '$tvt' )  ";
            $querytk = mysqli_query($connect, $sqltk);
            while ($rowtk = mysqli_fetch_assoc($querytk))
            {
              $arraytk[$rowtk['TenHoaChat']]=$rowtk['SLT'];
            }
          }
          $tmp = 0;
          $check = 0;
          $escLoop = 0;
          $count = 0;
          foreach ($arrayPhieu as $keyPhieu => $valuePhieu) {
            if ($escLoop == 0)
          {
            foreach ($arraytk as $keytk => $valuetk) {
             
              if (strtolower($keyPhieu) == strtolower($keytk))
              {
                $count ++;
                $sl = $valuetk - $valuePhieu;
                if ($sl >= 0)
                {
                  $sqlUpdate = "UPDATE tblhoachat SET  SLT = '$sl' WHERE TenHoaChat = '$keytk' ";
                  $queryUpdate = mysqli_query($connect, $sqlUpdate);
                }
                else
                {
                  $tmp = 1;
                  echo "<script>alert('Vượt quá số lượng tồn ! Vui lòng kiểm tra lại !')</script>";
                  $escLoop ++;
                  break;
                }
              }
            }
            if ($count == 0)
            {
              $check = 1 ;
            }
          }
        }
          if ($check == 1)
          {
            echo "<script>alert('Tên vật tư không tồn tại !')</script>";
          }
          if ($tmp == 0 && $check == 0)
          {
            $sqlTTP = "UPDATE tbl_phieuxuatkho SET  TrangThai = 1 WHERE MaPhieu = '$id' ";
            $queryTTP = mysqli_query($connect, $sqlTTP);
            echo("<script>location.href = '"."danh-sach-phieu-xuat-kho.php';</script>");
          }
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
                      Tiến hành xuất kho
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
   $(document).ready(function() {
        fetch_data();
      });
        $(document).on('click', '.check_box', function(){
          var html = '';
          if(this.checked)
          {
            html = '<td><input type="checkbox" STT="'+$(this).attr('stt')+'" data-TenVT="'+$(this).data('tenvt')+'" data-SL="'+$(this).data('sl')+'" class="check_box" checked /></td>';
            html += '<td><input type="text" id = "skill_input" name="TenVatTu[]" class="form-control" value="'+$(this).data("tenvt")+'" autocomplete = "off"/></td>';
            html += '<td><input type="text" name="SL[]" class="form-control" value="'+$(this).data("sl")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('stt')+'" /></td>';
          }
          else
          {
            html = '<td><input type="checkbox" STT="'+$(this).attr('stt')+'" data-TenVT="'+$(this).data('tenvt')+'" data-SL="'+$(this).data('sl')+'" class="check_box" /></td>';
            html += '<td>'+$(this).data('tenvt')+'</td>';
            html += '<td>'+$(this).data('sl')+'</td>';
          }
          $(this).closest('tr').html(html);
          $('.form-control').autocomplete({
            source: "chemistry_name.php",
          });
        })  ;
        $('#update_form').on('submit',function(event){
          if (confirm("Xác nhận lưu dữ liệu !"))
          {
            event.preventDefault();
            if($('.check_box:checked').length > 0)
            {
              $.ajax({
                url:"saveDataXuatKho.php",
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
                url:"deleteDataXuatKho.php",
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
 
        function fetch_data()
        {
          $.ajax({
            url:"dataXuatKho.php?id=<?php echo $id ?>",
            method:"GET",
            dataType:"json",
            success:function(data)
            {
              var html = '';
              for(var count = 0; count < data.length; count++)
              {
                html += '<tr>';
                html += '<td><input type="checkbox" STT="'+data[count].STT+'"data-TenVT="'+data[count].TenVT+'" data-SL="'+data[count].SL+'" class="check_box"  /></td>';
                html += '<td>'+data[count].TenVT+'</td>';
                html += '<td>'+data[count].SL+'</td>';
              }
              $('tbody').html(html);
            }
          });
        }
    </script>
    <!-----===============================================SCRIPT===============================================--->
    <script>
      $('.addfiles').on('click', function() { 
        $('#file-upload').click();
        return false;

      });
    </script>
    <script>
        //Add Input Fields
      $(document).ready(function() {
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
          $(wrapper).append('<div> <div  style="display: flex;"> <div style="width: 110%"class="form-group"><input id ="skill_input" type="text" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư" class="form-control" required autocomplete = "off"> </div> <div style="width: 110%"class="form-group"> <input type="number" value="" name="sl[]" placeholder="Số lượng "class="form-control" required> </div>  <a href="javascript:void(0);" class="remove_field"><div class="input-group-addon"><i class="fa fa-minus-square"></i></div></a></div>');
        }
           $('.form-control').autocomplete({
            source: "chemistry_name.php",
          });
      });
        //when user click on remove button
        $(wrapper).on("click",".remove_field", function(e){
          e.preventDefault();
        $(this).parent('div').remove(); //remove inout field
        x--;
      });
         
       
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('input[type="file"]').change(function(e){
          var fileName = e.target.files[0].name;
          $(this).prev('button').text(fileName);
        });
      });
    </script>
       <!--  <script>
        $(function() {
        $("#skill_input").autocomplete({
        source: "chemistry_name.php",
        });
        });
      </script> -->
       <script>
      $(function() {
        $('.form-control').autocomplete({
            source: "chemistry_name.php",
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