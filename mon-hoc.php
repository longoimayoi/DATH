<?php include 'header.php'; ?>
<body>
    <?php include 'leftpanel.php' ; ?>
     <?php
       $idKhoa = $_GET['id'];
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
  $mamh = $cell->nodeValue;
  if($index == 2)
  $tenmh = $cell->nodeValue;
  if($index == 3)
  $hsk = $cell->nodeValue;
  if($index == 4)
  $stc = $cell->nodeValue;
   $index++;
  }
   date_default_timezone_set('Asia/Ho_Chi_Minh');
  $data[]=array(
  'MaMon' =>$mamh,
  'TenMon' =>$tenmh,
  'HeSoK'  =>$hsk,
  'SoTinChi'  =>$stc,
  );
  }
  $first_row = false;
  }
  }
  if($data)
  {
  $dem_tt=0;
  foreach ($data as $row)
  {
  if($dem_tt>0)
  {
  // date_default_timezone_set('Asia/Ho_Chi_Minh');
  // $today=date("Y-m-d H:i:s");
 
  $a1=$row['MaMon'];
  $a2=$row['TenMon'];
  $a3=$row['HeSoK'];
  $a4=$row['SoTinChi'];
  $query="INSERT INTO monhoc (MaMon,TenMon,HeSoK,SoTinChi,MaKhoa)
  VALUES('$a1','{$a2}','$a3','$a4','$idKhoa')";
  $results=mysqli_query($connect,$query);
  }
  $dem_tt++;
  }
  echo("<script>location.href = '"."mon-hoc.php?id=".$idKhoa."';</script>");
  }
  }
  ?>




    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div style="margin-left:  14px"class="card-body text-secondary"><button style="background:transparent;border: 1.65px solid #007bffeb"type="submit" data-toggle="modal" data-target="#taophieuxuat">   <i style="color: #007bffeb"class="fa fa-plus" aria-hidden="true"></i></button></div>

                        <div class="card-body text-secondary"><button style="margin-right:  14px;float: right"type="submit" data-toggle="modal" data-target="#xemthongtin">  Sửa ảnh khoa </button></div>
                       <!--  <div id="row" > -->
                            <form class="card-body text-secondary" style="margin-right: 10px" name='import' method="POST" enctype="multipart/form-data">
                            <div class="submit" style="float: right;margin-right: 1px">
                                <button for="file-upload" style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"> Chọn</i> </button>
                                <input id="file-upload" type="file" name="file" multiple style='display: none;'>
                                <button type="submit" name="import">Nhập excel</button>
                                  </form>
                            <!-- </div> -->
                        
                    </div>
                    
                    
                    
                </div>
                
                
                <div class="col">
                    <button style="display: none">X</button>
                </div>
                <!--  <div style="margin-right: 14px">
                    
                    <div class="card-body text-secondary"><button for="file-upload" style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"> Chọn</i> </button>
                        <input id="file-upload" type="file" name="file" multiple style='display: none;'>
                        <button type="submit" name="import">Nhập excel</button>
                    <button type="submit" name="import">Xuất excel</button></div>
                    
                </div> -->
                
            </div>
        </div>
        <!--
        <div style="height: 60px;margin:0 auto">
            
            
            
        </div> -->
        <?php
        $idKhoa = $_GET['id'];
        $sqlKhoa = "SELECT TenKhoa FROM tblkhoa WHERE MaKhoa =".$idKhoa;
        $queryKhoa = mysqli_query($connect, $sqlKhoa);
        $rowKhoa = mysqli_fetch_assoc ($queryKhoa);
        ?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title"><?php echo $rowKhoa['TenKhoa'] ?></strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Số thứ tự</th>
                                <th>Mã môn</th>
                                <th>Tên môn</th>
                                <th>Hệ số K</th>
                                <th>Số tín chỉ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlNH = "SELECT * FROM namhoc";
                            $queryNH = mysqli_query($connect, $sqlNH);
                            
                            $soTT = 0;
                            $sql = "SELECT id, MaMon, TenMon, HeSoK,SoTinChi FROM monhoc WHERE MaKhoa =".$idKhoa;
                            $query = mysqli_query($connect, $sql);
                            while ($row = mysqli_fetch_array($query)) {
                            $soTT ++;
                            ?>
                            <tr>
                                <td><?php echo $soTT ?></td>
                                <td><?php echo $row[1] ?></td>
                                <td><?php echo $row[2] ?></td>
                                <td><?php echo $row[3] ?></td>
                                <td><?php echo $row[4] ?></td>
                                <td>
                                    <a title="Xem chi tiết" data-toggle="modal" data-target="#xemchitiet<?php echo $row[0] ?>" href="chi-tiet-mon.php?id=<?php echo $row[0] ?>"  class="ti-eye"></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div><!-- .animated -->
</div>
<?php
$queryDetail="SELECT MaKhoa, TenKhoa, Hinh FROM tblkhoa where Loai = 1 and MaKhoa=".$idKhoa;
$resultDetail = mysqli_query($connect, $queryDetail);
while ($row=mysqli_fetch_array($resultDetail,MYSQLI_ASSOC))
{
?>
<div class="modal fade" id="xemthongtin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="max-width:  500px!important;max-height:   500px!important" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="sua-anh-khoa.php?id=<?php echo $row['MaKhoa'] ?>" enctype="multipart/form-data">
                    
                    <div class="row form-group">
                        <div class="col col-md-3"><label  class=" form-control-label">Đổi ảnh khoa:</label></div>
                        <div style="height: 280px" class="col-12 col-md-9"><img style="height: 80%" src="images/<?php echo $row['Hinh']?>">
                            <input type="file" name="hinh"  >
                        </div>
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
<!-----====================================================================================================--->
<!-----========================================POPUP THÊM PHIẾU NHẬP KHO==================================--->
<?php
if(isset($_POST['submit']))
{
$MaMon=$_POST['MaMon'];
$TenMon=$_POST['TenMon'];
$HeSoK=$_POST['HeSoK'];
$sql1 = "INSERT INTO monhoc(MaMon,TenMon,HeSoK,MaKhoa)
VALUES('$MaMon','$TenMon',' $HeSoK','$idKhoa')";
$query = mysqli_query($connect,$sql1);
if(mysqli_affected_rows($connect)==1)
{
$id=mysqli_insert_id($connect);
echo("<script>location.href = '"."mon-hoc.php?id=$idKhoa';</script>");
}
else
{
// echo "<script>alert('Lập phiếu không thành công')</script>";
}
}
?>
<div class="modal fade" id="taophieuxuat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="max-width: 800px!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <label style="margin: 0 auto">THÊM MÔN HỌC</label>
                <!--    <input type="checkbox" id="checkedit" name="edit">
                <button  style="background-color: #217346" type="submit" name="edit" id="show" class="hidden">Sửa</button> -->
            </div>
            <div class="modal-body" >
                <form method = "post" >
                    <div id="checkopenedit">
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Mã môn học:</label></div>
                            <div class="col-12 col-md-9"><input type="text" name="MaMon" class="form-control" placeholder = "Nhập mã môn học" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Tên môn học:</label></div>
                            <div class="col-12 col-md-9"><input type="text"class="form-control" name="TenMon" placeholder ="Nhập tên môn học" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label  class=" form-control-label">Hệ số k:</label></div>
                            <div class="col-12 col-md-9"><input type="text" name="HeSoK"class="form-control" placeholder ="Nhập hệ số k" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label  class=" form-control-label">Số tín chỉ:</label></div>
                            <div class="col-12 col-md-9"><input type="text" name="SoTinChi"class="form-control" placeholder ="Nhập số tín chỉ môn học" required></div>
                        </div>
                        <!--      <div class="row form-group">
                            <div class="col col-md-3"><label  class=" form-control-label">Tổng số mặt hàng:</label></div>
                            <div class="col-12 col-md-9"><input type="text"class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Tổng khối lượng:</label></div>
                            <div class="col-12 col-md-9"><input type="text"class="form-control"></div>
                        </div> -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-default" data-dismiss="modal">Thoát</button>
                            <button type="submit" name = "submit" class="btn btn-primary">Tạo mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-----====================================================================================================--->
<!-----========================================POPUP CHI TIẾT MÔN HỌC==================================--->
<?php
include('connect/function.php') ;
$query="SELECT * FROM monhoc WHERE MaKhoa = '{$idKhoa}' ORDER BY id ";
$result = mysqli_query($connect, $query);
$item = mysqli_fetch_assoc($result);
if(isset($_POST['update']))
{
$MaMon = $_POST["mamon"];
$TenMon = $_POST["tenmon"];
$HeSoK = $_POST["hesok"];
$SoTinChi = $_POST["sotinchi"];
$sql1 = "UPDATE monhoc set  MaMon='$MaMon', TenMon='$TenMon',HeSoK='$HeSoK',SoTinChi='$SoTinChi' WHERE id=".$item['id'];
$query = mysqli_query($connect,$sql1);
if(mysqli_affected_rows($connect)==1)
{
echo "<script>alert('Sửa môn học thành công')</script>";
echo"<script>window.location.reload()</script>";
}
}
?>
<div class="modal fade" id="xemchitiet<?php echo $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="max-width: 800px!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <label style="margin: 0 auto">CHỈNH SỬA THÔNG TIN MÔN <?php echo $item['MaMon'] ?></label>
                <!--    <input type="checkbox" id="checkedit" name="edit">
                <button  style="background-color: #217346" type="submit" name="edit" id="show" class="hidden">Sửa</button> -->
            </div>
            <div class="modal-body" >
                <form method = "post" >
                    <div id="checkopenedit">
                        <div class="row form-group">
                            <div class="col col-md-3"><label class="form-control-label">Mã môn học:</label></div>
                            <div class="col-12 col-md-9"><input type="text"  name="mamon" value="<?php echo $item['MaMon'] ?>" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label class=" form-control-label">Tên môn học:</label></div>
                            <div class="col-12 col-md-9"><input type="text"  name="tenmon" value="<?php echo $item['TenMon'] ?>" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label  class=" form-control-label">Hệ số k:</label></div>
                            <div class="col-12 col-md-9"><input type="text"  name="hesok" value="<?php echo $item['HeSoK'] ?>" class="form-control"></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label  class=" form-control-label">Số tín chỉ:</label></div>
                            <div class="col-12 col-md-9"><input type="text"  name="sotinchi" value="<?php echo $item['SoTinChi'] ?>" class="form-control"></div>
                        </div>
                        <div class="modal-footer">
                            <!--      <button type="reset" name="delete" data-dismiss="modal">Xóa</button> -->
                            <button type="submit" name = "update" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-----===============================================SCRIPT===============================================--->
<script>
$('.addfiles').on('click', function() { $('#file-upload').click();return false;});
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