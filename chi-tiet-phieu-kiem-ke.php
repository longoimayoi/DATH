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
   <?php
    $sql = "SELECT TenPhieu, TenDangNhap, NgayLapPhieu, nh.NamHoc, k.TenKhoa, GhiChu, pkk.TrangThai FROM phieukiemke pkk, tbltaikhoan tk, tblkhoa k, namhoc nh WHERE pkk.NguoiLapPhieu = tk.MaTK and pkk.Khoa = k.MaKhoa and pkk.NamHoc = nh.id and MaPhieu =" . $id;
    $query = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc ($query);
    $tenPhieu = mb_strtoupper($row["TenPhieu"]);
    ?>
  <div class="content mt-3">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <strong><?php echo $tenPhieu ?></strong>
        </div>
        <div class="card-body card-block">
          <div class="row">
            <div class="col-6">
             
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
            <div class="col-6">
              <div class="form-group">
                <label for="cc-exp" class="control-label mb-1">Khoa</label>
                <div class="input-group">
                  
                  <input style="background-color: #d0d0d03b" type="text" id="input1-group1" name="input1-group1" disabled="" value="<?php echo $row["TenKhoa"] ?>" class="form-control"><div class="input-group-addon"><i class="ti-control-backward"></i></div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="cc-exp" class="control-label mb-1">Năm học</label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="ti-time"></i></div>
                  <input style="background-color: #d0d0d03b" disabled="" value="<?php echo $row["NamHoc"] ?>"type="text" id="input1-group1" name="input1-group1" class="form-control">
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
        <div class="col">
          <button style="display: none">X</button>
        </div>
        <div style="margin-right: 14px">
          <div style="display: flex" class="card-body text-secondary">
              <div>
            <form action="" method="post" enctype="multipart/form-data">
            <button for="file-upload" style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"> Chọn</i> </button>
            <input id="file-upload" type="file" name="file" multiple style='display: none;'>
            <button type="submit" name="import">Nhập excel</button> 
            </form>
            </div>
            <div>
          <a  href="export-chi-tiet-phieu-nhap-kho.php?id=<?php echo $id ?>"><button type="submit" class="callback"  name="import">Xuất excel</button> </a>
          </div>

       
        </div>
      </div>
      </div>
    </div>
    <?php 
    if(isset($_POST['lapPhieu']))
    {
      $tenvattu = $_POST["tenvattu"];
      $sltondauky = $_POST["sltondauky"];
      $slnhaptrongky = $_POST["slnhaptrongky"];
      $slxuattrongky = $_POST["slxuattrongky"];
      $sltontrongky = $_POST["sltontrongky"];
      $sltonthucte = $_POST["sltonthucte"];
      $sltoncuoiky = $_POST["sltoncuoiky"];
      $slsddencuoiky = $_POST["slsddencuoiky"];
      $ghichu = $_POST["ghichu"];
    foreach ($tenvattu as $k => $v) {
      $sqlInsert = "INSERT INTO ctphieukiemke (MaPhieu, TenVatTu, SLTonDauKy, SLNhapTrongKy, SLXuatTrongKy, SLTonTrongKy, SLTonThucTe, SLSuDungDenCuoiKy,SLTonCuoiKy, GhiChu)
    VALUES ('$id', '$v', '$sltondauky[$k]', '$slnhaptrongky[$k]', '$slxuattrongky[$k]','$sltontrongky[$k]', '$sltonthucte[$k]','$slsddencuoiky[$k]','$sltoncuoiky[$k]', '$ghichu[$k]')";
      $queryInsert = mysqli_query($connect, $sqlInsert);
    }
    $sqlUpdateKK = "UPDATE phieukiemke SET TrangThai = 1 WHERE MaPhieu =".$id;
    $queryUpdateKK = mysqli_query($connect, $sqlUpdateKK);
    echo("<script>location.href = '"."kiem-ke.php';</script>");
    }
     ?>
        <form method="post">
        <br />
        <div class="table-responsive" id = "table-container">
          <table id = "maintable" class="table table-bordered table-striped" >
            <thead>
              <th width="17%">Tên vật tư</th>
              <th >ĐVT</th>
              <th >SL Tồn đầu kỳ</th>
              <th >SL Nhập trong kỳ</th>
              <th >SL Xuất trong kỳ</th>
              <th >SL Tồn trong kỳ</th>
              <th >SL Tồn thực tế</th>
              <th >SL Sử dụng đến cuối kỳ</th>
              <th >SL Tồn cuối kỳ</th>
              <th width="20%">Ghi Chú</th>
            </thead>
            <tbody>
              <?php
              if ($row['TrangThai'] == 0)
              {
              $index = 0;
            
             
             //List sl nhap trong ky
              $sqlPNK = "SELECT TenVT, SUM(SL) as SL FROM ctphieunhapkho GROUP BY TenVT";
               $queryPNK = mysqli_query($connect, $sqlPNK);    
               while ($rowPNK= mysqli_fetch_assoc($queryPNK))
               {
                 $arrayPNK[$rowPNK['TenVT']]=$rowPNK['SL'];
               }

               //List sl xuat trong ky
              $sqlPXK = "SELECT TenVT, SUM(SL) as SL FROM ctphieuxuatkho GROUP BY TenVT";
               $queryPXK = mysqli_query($connect, $sqlPXK);
               while ($rowPXK= mysqli_fetch_assoc($queryPXK))
               {
                 $arrayPXK[$rowPXK['TenVT']]=$rowPXK['SL'];
               }
            $sqlVT = "SELECT * FROM tblhoachat WHERE TrangThai = 1";
              $queryVT = mysqli_query($connect, $sqlVT);
              while ($rowVT = mysqli_fetch_assoc($queryVT))
              {
                ?>
             <tr>
                <td><input type="text" name = "tenvattu[]" class = "form-control" value="<?php echo $rowVT['TenHoaChat']; ?>" readonly></td>
                <td><?php echo $rowVT['DVT']; ?></td>
                <td><input type="number" name = "sltondauky[]" class = "form-control" value="<?php echo $rowVT['SLT']; ?>" ></td>
                <?php 
                //lay sl nhap trong ky
                foreach ($arrayPNK as $TenVTNK => $SLNK) {
                    if ($rowVT['TenHoaChat'] == $TenVTNK)
                    {
                      $SLNTK = $SLNK;
                      break;
                    } 
                    else 
                    {
                      $SLNTK = 0;
                    }
                }

                //lay sl xuat trong ky
                 foreach ($arrayPXK as $TenVTXK => $SLXK) {
                    if ($rowVT['TenHoaChat'] == $TenVTXK)
                    {
                      $SLXTK = $SLXK;
                      break;
                    } 
                    else 
                    {
                      $SLXTK = 0;
                    }
                }

                //tinh sl ton trong ky
                $SLTTK = $rowVT['SLT'] + $SLNTK - $SLXTK;
               
                 ?>
                <td><input type="number" name = "slnhaptrongky[]" class = "form-control" value="<?php echo $SLNTK; ?>" readonly></td>
                <td><input type="number" name = "slxuattrongky[]" class = "form-control" value="<?php echo $SLXTK; ?>" readonly></td>
                <td><input type="number" name = "sltontrongky[]" class = "form-control" value="<?php echo $SLTTK; ?>" readonly></td>
                <td><input type="number" id = "sltonthucte_<?php echo $rowVT['id']; ?>" name = "sltonthucte[]" class = "form-control"></td>
                <td><input type="number" id = "slsddck-<?php echo $rowVT['id']; ?>" name = "slsddencuoiky[]" class = "form-control1"></td>
                <td><input type="number" id = "sltoncuoiky_<?php echo $rowVT['id']; ?>" name = "sltoncuoiky[]" class = "form-control" readonly></td>
                <td><input type="text" name = "ghichu[]" class = "form-control"></td>

              </tr>

          
             <?php
              }
              }
              else
              {
                $sqlXemPhieu = "SELECT * FROM ctphieukiemke WHERE MaPhieu=".$id;
                $queryXemPhieu = mysqli_query($connect, $sqlXemPhieu);
               
                while ( $rowXemPhieu = mysqli_fetch_assoc($queryXemPhieu)) {
                
             ?>
                <tr>
                <td><input type="text" name = "tenvattu[]" class = "form-control" value="<?php echo $rowXemPhieu['TenVatTu']; ?>" readonly></td>
                <td><input type="text" name = "dvt[]" class = "form-control" value="<?php echo $rowXemPhieu['DVT']; ?>" readonly> </td>
                <td><input type="number" name = "sltondauky[]" class = "form-control" value="<?php echo $rowXemPhieu['SLTonDauKy']; ?>" ></td>
                <td><input type="number" name = "slnhaptrongky[]" class = "form-control" value="<?php echo $rowXemPhieu['SLNhapTrongKy']; ?>"></td>
                <td><input type="number" name = "slxuattrongky[]" class = "form-control" value="<?php echo $rowXemPhieu['SLXuatTrongKy']; ?>"></td>
                <td><input type="number" name = "sltontrongky[]" class = "form-control" value="<?php echo $rowXemPhieu['SLTonTrongKy']; ?>"></td>
                <td><input type="number" id = "sltonthucte_<?php echo $rowXemPhieu['id']; ?>" name = "sltonthucte[]" class = "form-control" value = "<?php echo $rowXemPhieu['SLTonThucTe'] ?>"></td>
                <td><input type="number" id = "slsddck-<?php echo $rowXemPhieu['id']; ?>" name = "slsddencuoiky[]" class = "form-control1" value = "<?php echo $rowXemPhieu['SLSuDungDenCuoiKy'] ?>"></td>
                <td><input type="number" id = "sltoncuoiky_<?php echo $rowXemPhieu['id']; ?>" name = "sltoncuoiky[]" class = "form-control" value = "<?php echo $rowXemPhieu['SLTonCuoiKy'] ?>"></td>
                <td><input type="text" name = "ghichu[]" class = "form-control" value = "<?php echo $rowXemPhieu['GhiChu'] ?>"></td>

              </tr>
           <?php } } ?>
            </tbody>
          </table>
          <table id="bottom_anchor"></table>
        </div>
        <div id="row" >
                <div class="col-md-6 offset-md-3">
                  <section style="border:none"class="card">
                    <div class="submit" style="margin:0 auto" >
                      <button type="submit" name="lapPhieu" >
                        Hoàn thành kiểm kê
                      </button>
                      
                      <button type="submit" name ="xoaPhieu" style="background-color:red" >
                        Thoát 
                      </button>
                    </div>
                  </section>
                </div>
                
              </div>
      </form>
  </div>

      
        <!-----===============================================SCRIPT===============================================--->
          <script type="text/javascript">
          $(document).ready(function(){
          $('input[type="file"]').change(function(e){
          var fileName = e.target.files[0].name;
          $(this).prev('button').text(fileName);
          });

            
           $(".form-control1").keyup(function(){
              var id = this.id;
              var split = id.split("-");
             var slttt = $("#sltonthucte_"+split[1]).val();
              var slsddck = $("#slsddck-"+split[1]).val();
              var sub = slttt - slsddck;
              $("#sltoncuoiky_"+split[1]).val(sub);

              if ($("#sltoncuoiky_"+split[1]).val() < 0)
              {
                $("#sltoncuoiky_"+split[1]).val(0);
              }
           });

          });
          </script>
          <script>
           function moveScroll(){
    var scroll = $(window).scrollTop();
    var anchor_top = $("#maintable").offset().top;
    var anchor_bottom = $("#bottom_anchor").offset().top;
    if (scroll>anchor_top && scroll<anchor_bottom) {
    clone_table = $("#clone");
    if(clone_table.length == 0){
        clone_table = $("#maintable").clone();
        clone_table.attr('id', 'clone');
        clone_table.css({position:'fixed',
                 'pointer-events': 'none',
                 top:0});
        clone_table.width($("#maintable").width());
        $("#table-container").append(clone_table);
        $("#clone").css({visibility:'hidden'});
        $("#clone thead").css({visibility:'visible'});

    }
    } else {
    $("#clone").remove();
    }
}
$(window).scroll(moveScroll);
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