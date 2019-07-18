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
  <!-- <div class="content mt-3">
    <div class="col-lg-12">
      <div class="card"> -->
        <!-- <div class="card-header">
          <strong>CHI TIẾT PHIẾU NHẬP KHO</strong>
        </div> -->
       <!--  <div class="card-body card-block">
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
        </div> -->
      <!-- </div> -->
   <!--  </div>
  </div> -->
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
         <!--  <div class="col-sm-3">
            <div class="card-body text-secondary">
              <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">Thêm vật tư</button>
            </div>
          </div> -->
        <?php } ?>
        <div class="col">
          <button style="display: none">X</button>
        </div>
        <div style="margin-right: 14px">
          <div style="display: flex" class="card-body text-secondary"><?php if ($status == 0)
          { ?>
            <div>
              <form action="" method="post" enctype="multipart/form-data">
            <!--     <button for="file-upload" style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"> Chọn</i> </button> -->
                <input id="file-upload" type="file" name="file" multiple style='display: none;'>
                <button type="submit" name="import">Xuất excel</button> 
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
            /*echo "<script>alert('Thêm chi tiết thành công')</script>";*/
            echo("<script>location.href = '"."chi-tiet-phieu-nhap-kho.php?id=$id';</script>");
          }
          else
          {
            echo "<script>alert('Lập phiếu không thành công')</script>";
          }
        }
      }
      ?>
    <!--   <div id="collapse1" class="col-lg-12 panel-collapse collapse">
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
      </div> -->
      <?php 
      if (isset($_POST['luuTamThoi']))
          {
            $sqlSum = "SELECT MaHD, SUM(SL) AS SL, SUM(SLDaNhap) AS SLDaNhap FROM tblphieuyeucautrangbi WHERE MaHD = '$id' GROUP BY MaHD";
            $querySum = mysqli_query($connect, $sqlSum);
            $rowSum = mysqli_fetch_assoc($querySum);
            $mucDoHoanThanh = ($rowSum["SLDaNhap"]/$rowSum["SL"])*100;
            $stt = $_POST["stt"];
            $sldn = $_POST["sl"];
            $tt = $_POST["TinhTrang"];
            foreach ($stt as $key => $value) {
           $sqlUpdate = "UPDATE tblphieuyeucautrangbi SET  SLDaNhap = '$sldn[$key]', TinhTrangNhap = '$tt[$key]' WHERE STT = '$value' ";
           $queryUpdate = mysqli_query($connect, $sqlUpdate);
            }
             $sqlUpdatePhieu = "UPDATE tblhoadon SET  MucDoHoanThanh = '$mucDoHoanThanh' WHERE MaHD = '$id' ";
           $queryUpdatePhieu = mysqli_query($connect, $sqlUpdatePhieu);
          }
           ?>
      <?php
      $sqlct = "SELECT * FROM tblphieuyeucautrangbi WHERE MaHD=".$id;
      $queryct = mysqli_query($connect, $sqlct);
      $count = mysqli_num_rows($queryct);
      if ($count > 0)
      {
        ?>
        <div class="col-lg-12">
          <div class="card">
            <form method="post" >
              <div class="card-header">
                <strong style="position: relative;" class="card-title">DANH SÁCH VẬT TƯ NHẬP KHO</strong>

                <!--  -->
              </div>
              <!--    <form method="post" id="update_form"> -->
                <br />
                <div class="card-body">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <th width="10%">Mã vật tư</th>
                      <th width="20%">Tên vật tư</th>
                      <th width="10%">Đơn vị tính</th>
                      <th width="5%">Số lượng</th>
                      <th width="10%">Số lượng đã nhập</th>
                      <th width="20%">Thông số KT</th>
                      <th width="10%">Xuất xứ</th>
                      <th width="20%">Ghi chú</th>
                      <th width="20%">Tình trạng</th>
                    </thead>
                    <?php  while ($row=mysqli_fetch_array($queryct,MYSQLI_ASSOC)) {
                      $ttn = $row['TinhTrangNhap'];
                     ?>

                     <tbody>
                      <input type="hidden" value="<?php echo $row['STT'] ?>" name="stt[]" placeholder=""class="form-control" >
                      <td><?php echo $row['MaVatTu'] ?></td>
                      <td><?php echo $row['TenVatTu'] ?></td>
                      <td><?php echo $row['DVT'] ?></td>
                      <td><?php echo $row['SL'] ?></td>
                      <th width="10%"><input type="number" value="<?php echo $row['SLDaNhap'] ?>" name="sl[]" placeholder="" class="form-control" ></th>
                      <td><?php echo $row['ThongSoKT'] ?></td>
                      <td><?php echo $row['XuatXu'] ?></td>
                      <td><?php echo $row['GhiChu'] ?></td>
                      <td> <select name = "TinhTrang[]">
                        <option value="0" <?php if($ttn==0) echo 'selected' ?> >Không</option>
                        <option value="1" <?php if($ttn==1) echo 'selected' ?> >Có</option>
                        <option value="2" <?php if($ttn==2) echo 'selected' ?> >Thiếu</option>
                      </select>
                      </td>
                      </tbody>
                    <?php } ?>
                  </table>
                </div>
                 <div class="col-md-6 offset-md-3">
                  <section style="border:none"class="card">
                    <div class="submit" style="margin:0 auto" >
                      <button type="submit" name="lapPhieu" >
                        Tiến hành nhập kho
                      </button>
                       <button type="submit" name="luuTamThoi" >
                        Lưu
                      </button>
                      <button type="submit" name ="xoaPhieu" style="background-color:red" >
                        Hủy phiếu
                      </button>
                    </div>
                  </section>
                </div>
              </form>
          <!--        <form method = "post">
            <input type="submit" name = "delete" style="background-color: #ff0000d6" value="Hủy phiếu"/>
          </form> -->
          <?php
          if (isset($_POST['xoaPhieu']))
          {
           /* $sqlDelete = "DELETE FROM tbl_phieunhapkho WHERE MaPhieu=".$id;
            $sqlDeleteDetail = "DELETE FROM ctphieunhapkho WHERE MaPhieu=".$id;
            $queryDelete = mysqli_query($connect, $sqlDelete);
            $queryDeleteDetail = mysqli_query($connect, $sqlDeleteDetail);*/
            echo("<script>location.href = '"."danh-sach-phieu-nhap-kho.php';</script>");
          }

          if (isset($_POST['lapPhieu']))
          {
            $sql = "SELECT * FROM tblphieuyeucautrangbi WHERE  MaHD='$id'  ";
            $query = mysqli_query($connect, $sql);
            $arr = array();
            $arrayPhieu = array();
            $arrayTVT = array();
            while ($row = mysqli_fetch_assoc($query))
            {
              array_push($arr, $row['MaVatTu']);
              $arrayPhieu[$row['MaVatTu']]=$row['SL'];
               $arrayTVT[$row['MaVatTu']]=$row['TenVatTu'];
            }
            $arraytk = array();
            foreach($arr as $tvt)
            {
              $sqltk = "SELECT * FROM tblhoachat WHERE MaVatTu in (SELECT MaVatTu from tblphieuyeucautrangbi where MaHD='$id'  and MaVatTu = '$tvt' )  ";
              $querytk = mysqli_query($connect, $sqltk);
              while ($rowtk = mysqli_fetch_assoc($querytk))
              {
                $arraytk[$rowtk['MaVatTu']]=$rowtk['SLT'];
              }
            }
            
            foreach ($arrayPhieu as $keyPhieu => $valuePhieu) {
              $count = 0;
              foreach ($arraytk as $keytk => $valuetk) {
                if ($keyPhieu == $keytk)
                {
                  $sl = $valuePhieu + $valuetk;
                  $sqlUpdate = "UPDATE tblhoachat SET  SLT = '$sl' WHERE MaVatTu = '$keytk' ";
                  $queryUpdate = mysqli_query($connect, $sqlUpdate);
                  $count ++;
                  break;
                }
              }
              if ($count == 0)
              {
                $sqlInsert="INSERT INTO tblhoachat (MaVatTu,TenHoaChat, SLT, TrangThai, NgayHetHan, NgayMoNap)
                VALUES('{$keyPhieu}','{$arrayTVT[$keyPhieu]}','{$valuePhieu}',1,'0000-00-00', '0000-00-00')";
                $queryInsert=mysqli_query($connect,$sqlInsert);
              }
            }
           /* $sqlTTP = "UPDATE tbl_phieunhapkho SET  TrangThai = 1 WHERE MaPhieu = '$id' ";
            $queryTTP = mysqli_query($connect, $sqlTTP);*/
            echo("<script>location.href = '"."danh-sach-phieu-nhap-kho.php';</script>");
          }
          ?>
          <?php if ($status == 0)
          { ?>
            <form method="post" >
              <div id="row" >
               
                
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

      <script>
        $('.addfiles').on('click', function() { $('#file-upload').click();return false;});
      </script>
    <!--   <script>
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
            $(wrapper).append('<div> <div  style="display: flex;"> <div style="width: 110%"class="form-group"><input id = "skill_input" type="text" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư"class="form-control" required autocomplete="off"> </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="dvtinh[]" placeholder="Đơn vị tính"class="form-control" required> </div>  <div style="width: 110%"class="form-group"> <input type="number" value="" name="sl[]" placeholder="Số lượng "class="form-control" required> </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="thongso[]" placeholder="Thông số kỹ thuật"class="form-control" >  </div> <div style="width: 110%"class="form-group">  <input type="text" value="" name="xuatxu[]" placeholder="Xuất xứ"class="form-control" > </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="ghichu[]" placeholder="Ghi chú"class="form-control">  </div>  <a href="javascript:void(0);" class="remove_field"><div class="input-group-addon"><i class="fa fa-minus-square"></i></div></a></div></div>');
          }
        });
          //when user click on remove button
          $(wrapper).on("click",".remove_field", function(e){
            e.preventDefault();
          $(this).parent('div').remove(); //remove inout field
          x--;
        })
        });
      </script> -->
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