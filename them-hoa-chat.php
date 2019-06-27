<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');
include('connect/function.php');
?>
<style type="text/css">
.required{
color: red;
}
</style>
<body>
  <?php
  include 'leftpanel.php' ;?>
  <?php
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
  $mavt = $cell->nodeValue;
  if($index == 2)
  $tenhc = $cell->nodeValue;
  if($index == 3)
  $dvt = $cell->nodeValue;
  if($index == 4)
  $slt = $cell->nodeValue;
  if($index == 5)
  $vitri = $cell->nodeValue;
  if($index == 6)
  $chuy = $cell->nodeValue;
  if($index == 7)
  $dkbq = $cell->nodeValue;
  if($index == 8)
  $ngayhethan = $cell->nodeValue;
  if($index == 9)
  $ngaymonap = $cell->nodeValue;
  if($index == 10)
  $songayhethan = $cell->nodeValue;
  $index++;
  }
   date_default_timezone_set('Asia/Ho_Chi_Minh');
  $data[]=array(
  'MaVatTu' =>$mavt,
  'TenHoaChat' =>$tenhc,
  'DVT'  =>$dvt,
  'SLT'  =>$slt,
  'ViTriDat'  =>$vitri,
  'ChuY'  =>$chuy,
  'DieuKienBaoQuan'  =>$dkbq,
  'NgayHetHan'  =>$ngayhethan,
  'NgayMoNap'  =>$ngaymonap,
  'SoNgayHetHanSMN'  =>$songayhethan
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
  // date_default_timezone_set('Asia/Ho_Chi_Minh');
  // $today=date("Y-m-d H:i:s");
  $trangthai=2;
  $a1=$row['MaVatTu'];
  $a2=$row['TenHoaChat'];
  $a3=$row['DVT'];
  $a4=$row['SLT'];
  $a5=$row['ViTriDat'];
  $a6=$row['ChuY'];
  $a7=$row['DieuKienBaoQuan'];
  $a8=$row['NgayHetHan'];
  $a9=$row['NgayMoNap'];
  $a10=$row['SoNgayHetHanSMN'];
  $query="INSERT INTO tblhoachat(MaVatTu,TenHoaChat,DVT,SLT,ViTriDat,ChuY,DieuKienBaoQuan,NgayHetHan,NgayMoNap,SoNgayHetHanSMN)
  VALUES('{$a1}','{$a2}','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10')";
  $results=mysqli_query($connect,$query);
  }
  $dem_tt++;
  }
  echo("<script>location.href = '"."danh-sach-hoa-chat.php';</script>");
  }
  }
  ?>
  <?php
  if(isset($_POST['submit']))
  {
  $mavt=$_POST['mavt'];
  $tenhc=$_POST['tenhc'];
  // $cthh=$_POST['cthh'];
  $slt=$_POST['slt'];
  $dvt=$_POST['dvt'];
  // $nguyhiem=$_POST['nguyhiem'];
  $chuy=$_POST['chuy'];
  $vitri=$_POST['vitri'];
  // $noibaoquan=$_POST['noibaoquan'];
  $dkbq=$_POST['dkbq'];
  // $ycsd=$_POST['ycsd'];
  if(isset($_POST['ngayhethan']))
  {
  $ngayhethan=$_POST['ngayhethan'];
  }
  else
  {
  $ngayhethan=NULL;
  }
  if(isset($_POST['songayhethan']))
  {
  $songayhethan=$_POST['songayhethan'];
  }
  else
  {
  $songayhethan=NULL;
  }
  if(isset($_POST['ngaymonap']))
  {
  $ngaymonap=$_POST['ngaymonap'];
  }
  else
  {
  $ngaymonap=NULL;
  }
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $day=date("Y-m-d-H-i-s");
  $trangthai=1;
  if($slt < 0)
  {
  echo "<script>alert('Số lượng phải lớn hơn 0')</script>";
  }
  else if(is_numeric($dvt))
  {
  echo "<script>alert('Đơn vị tính phải là kiểu chuỗi')</script>";
  }
  elseif($_FILES['hinhanh'] )
  {
  $file_name=$_FILES['hinhanh']['name'];
  $file_tmp=$_FILES['hinhanh']['tmp_name'];
  for($i=0;$i<count($file_tmp);$i++)
  {
  if(move_uploaded_file($file_tmp[$i], "./HinhHoaChat/".$day.'-'.$file_name[$i]))
  {
  $hinhanh[$i]=$day.'-'.$file_name[$i];
  }
  }
  foreach ($tenhc as $k => $v)
  {
  $query="INSERT INTO tblhoachat(TenHoaChat,MaVatTu,SLT,DVT,ChuY,ViTriDat,DieuKienBaoQuan,NgayHetHan,NgayMoNap ,SoNgayHetHanSMN,HinhAnh,TrangThai) VALUES
  ('$v','$mavt[$k]','$slt[$k]','$dvt[$k]','$chuy[$k]','$vitri[$k]','$dkbq[$k]','$ngayhethan[$k]','$ngaymonap[$k]','$songayhethan[$k]','$hinhanh[$k]',$trangthai)";
  $result=mysqli_query($connect,$query);
  }
  if(mysqli_affected_rows($connect)>0)
  {
  echo "<script>alert('Thêm thành công')</script>";
  echo("<script>location.href = '"."them-hoa-chat.php';</script>");
  }
  else
  {
  echo "<script>alert('Thêm không thành công')</script>";
  }
  }
  //    else
  //    {
  //   foreach ($tenhc as $k => $v)
  //   {
  //   $query="INSERT INTO tblhoachat(TenHoaChat,CongThucHoaHoc,SLT,DVT,NguyHiemChinh,ChuY,ViTriDat,NoiBaoQuan,DieuKienBaoQuan,YeuCauKhiSuDung,NgayHetHan,NgayMoNap ,SoNgayHetHanSMN,TrangThai) VALUES
  //   ('$v','$cthh[$k]','$slt[$k]','$dvt[$k]','$nguyhiem[$k]','$chuy[$k]','$vitri[$k]','$noibaoquan[$k]','$dkbq[$k]','$ycsd[$k]','$ngayhethan[$k]','$nagymonap[$k]','$songayhethan[$k]',$trangthai)";
  //   $result=mysqli_query($connect,$query);
  //   }
  //   if(mysqli_affected_rows($connect)>0)
  //   {
  //   echo "<script>alert('Thêm hóa chất thành công')</script>";
  //    echo("<script>location.href = '"."them-hoa-chat.php';</script>");
  //   }
  //   else
  //   {
  //        echo "<script>alert('Thêm hóa chất không thành công')</script>";
  //   }
  // }
  }
  
  ?>
  <div class="col-lg-12">
    <div style="float: right;margin-right: 20px">
      <form class=".col-md-4 .ml-auto"name='import' method="POST" enctype="multipart/form-data">
        <div id="row" >
          <div class="submit" style="float: right;margin-right: 1px">
            <button for="file-upload" style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"> Chọn</i> </button>
            <input id="file-upload" type="file" name="file" multiple style='display: none;'>
            <button type="submit" name="import">Nhập excel</button>
          </div>
        </form>
      </div >
    </div>
    <!-- </div> -->
    
    <div class="content mt-3">
      <div class="animated fadeIn">
        <div class="row">
          <!--      <div class="row"> -->
          <div class="col-lg-12">
            <div class="card" >
              <div class="card-header">
                <strong>THÊM VẬT TƯ</strong>
              </div >
              <div class="card-body card-block">
                <form action="" method="POST" enctype="multipart/form-data" >
                  <div class="wrapper">

                    <div  style="display: flex;">
                      <div style="width: 95%;" id="lbform" class="form-control-label">
                        <label  class="form-control-label">Mã vật tư</label>
                      </div>
                      <div style="width: 95%;" id="lbform" class="form-control-label">
                        <label class="form-control-label">Tên vật tư</label>
                      </div>
                      <div style="width: 95%;"id="lbform" class="form-control-label">
                        <label class="form-control-label">Đơn vị tính</label>
                      </div>
                      <div style="width: 92%;" id="lbform" class="form-control-label">
                        <label  class="form-control-label">Số lượng</label>
                      </div>
                      <div style="width: 178px;"id="lbempty" class="form-control-label">
                        <label class="form-control-label"></label>
                      </div>
                    </div>

                    <div  style="display: flex;">
                      <div style="width: 110%"class="form-group">
                        <input type="text" name="mavt[]" value="" placeholder="Mã vật tư"class="form-control" required>
                      </div>
                      <div style="width: 110%"class="form-group">
                        <input type="text" value="" name="tenhc[]" placeholder="Tên vật tư"class="form-control" required>
                      </div>
                      <div style="width: 110%"class="form-group">
                        <input type="text" value="" name="dvt[]" placeholder="Đơn vị tính"class="form-control" >
                      </div>
                      <div style="width: 110%"class="form-group">
                        <input type="text" name="slt[]" value="" placeholder="Vị trí đặt"class="form-control" required>
                      </div>
                      <div class="form-group">
                        <div style="background-color: #fff;cursor: none;border: 1px solid #fff" id="add_fields" class="add_fields input-group-addon"><i style="color: white"class="fa fa-plus-square"></i></div>
                      </div>
                    </div>
                    <!--=============================== ROW 1 ===============================-->
                    <div  style="display: flex;">
                      <div style="width: 96%;" id="lbform" class="form-control-label">
                        <label  class="form-control-label">Vị trí đặt</label>
                      </div>
                      <div style="width: 96%;" id="lbform" class="form-control-label">
                        <label  class="form-control-label">Chú ý</label>
                      </div>
                      <div style="width: 90%;" id="lbform" class="form-control-label">
                        <label class="form-control-label">Điều kiện bảo quản</label>
                      </div>
                      <div style="width: 178px;"id="lbempty" class="form-control-label">
                        <label class="form-control-label"></label>
                      </div>
                    </div>

                    <div  style="display: flex;">
                      <div style="width: 110%"class="form-group">
                        <input type="text" name="vitri[]" value="" placeholder="Vị trí đặt"class="form-control" required>
                      </div>  
                      <div style="width: 110%"class="form-group">
                        <input type="text" name="chuy[]" value="" placeholder="Chú ý"class="form-control" >
                      </div>
                      <div style="width: 110%"class="form-group">
                        <input type="text" value="" name="dkbq[]" placeholder="Điều kiện bảo quản"class="form-control" >
                      </div>
                      <div class="form-group">
                        <div style="background-color: #fff;cursor: none;border: 1px solid #fff" id="add_fields" class="add_fields input-group-addon"><i style="color: white"class="fa fa-plus-square"></i></div>
                      </div>
                    </div>
                    <!--================================ ROW 2 =============================-->
                    <div  style="display: flex;">
                      <div style="width: 82%;" id="lbform" class="form-control-label">
                        <label  class="form-control-label">Ngày hết hạn</label>
                      </div>
                      <div style="width: 85%;"id="lbform" class="form-control-label">
                        <label class="form-control-label">Ngày mở nắp</label>
                      </div>
                      <div style="width: 85%;" id="lbform" class="form-control-label">
                        <label class="form-control-label">Số ngày hết hạn</label>
                      </div>
                      <div style="width: 95%;"id="lbform" class="form-control-label">
                        <label class="form-control-label">Hình ảnh</label>
                      </div>
                    </div>

                    <div  style="display: flex;">
                      <div style="width: 110%"class="form-group">
                        <input type="date" name="ngayhethan[]" value="" placeholder="Ngày hết hạn"class="form-control" >
                      </div>
                      <div style="width: 110%"class="form-group">
                        <input type="date" value="" name="ngaymonap[]" placeholder="Ngày mở nắp"class="form-control" >
                      </div>
                      <div style="width: 110%"class="form-group">
                        <input type="text" value="" name="songayhethan[]" placeholder="Số ngày hết hạn"class="form-control" >
                      </div>
                      <div style="width: 110%"class="form-group">
                        <input type="file" style="border: none"  name="hinhanh[]"  class="form-control" >
                      </div>
                      <div class="form-group">
                        <div  id="add_fields" class="add_fields input-group-addon"><i class="fa fa-plus-square"></i></div>
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
        </div>
      </div>
    </div>
    <?php include 'scriptindex.php'; ?>
  </body>
</html>
<script>
$('.addfiles').on('click', function() { $('#file-upload').click();return false;});
</script>
<script type="text/javascript">
jQuery(function($){
$('input[type="file"]').change(function(e){
var fileName = e.target.files[0].name;
$(this).prev('button').text(fileName);
});
});
</script>
<script>
//Add Input Fields
jQuery(function($) {
var max_fields = 20; //Maximum allowed input fields
var wrapper    = $(".wrapper"); //Input fields wrapper
var add_button = $(".add_fields"); //Add button class or ID
var x = 1; //Initial input field is set to 1
//When user click on add input button
$(add_button).click(function(e){
e.preventDefault();
//Check maximum allowed input fields
if(x < max_fields){
x++;
var selectPattern = $('#catalog-pattern').clone().html();
$(wrapper).append('<div> <div> <div><span><hr style="border:1.5px solid #007bff61; border-style:dashed"><span></div> <div  style="display: flex;">  <div style="width: 95%;" id="lbform" class="form-control-label"> <label  class="form-control-label">Mã vật tư</label> </div> <div style="width: 95%;" id="lbform" class="form-control-label"> <label class="form-control-label">Tên vật tư</label> </div> <div style="width: 95%;"id="lbform" class="form-control-label">  <label class="form-control-label">Đơn vị tính</label> </div> <div style="width: 92%;" id="lbform" class="form-control-label"> <label  class="form-control-label">Số lượng</label></div> <div style="width: 178px;"id="lbempty" class="form-control-label"> <label class="form-control-label"></label></div> </div> <div  style="display: flex;">  <div style="width: 110%"class="form-group"> <input type="text" name="mavt[]" value="" placeholder="Mã vật tư"class="form-control" required></div>  <div style="width: 110%"class="form-group"> <input type="text" value="" name="tenhc[]" placeholder="Tên vật tư"class="form-control" required></div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="dvt[]" placeholder="Đơn vị tính"class="form-control" >  </div>  <div style="width: 110%"class="form-group"><input type="text" name="slt[]" value="" placeholder="Vị trí đặt"class="form-control" required> </div>  <div class="form-group"> <div style="background-color: #fff;cursor: none;border: 1px solid #fff" id="add_fields" class="add_fields input-group-addon"><i style="color: white"class="fa fa-plus-square"></i></div>  </div> </div><div  style="display: flex;"> <div style="width: 96%;" id="lbform" class="form-control-label">   <label  class="form-control-label">Vị trí đặt</label> </div> <div style="width: 96%;" id="lbform" class="form-control-label">  <label  class="form-control-label">Chú ý</label> </div>      <div style="width: 90%;" id="lbform" class="form-control-label">   <label class="form-control-label">Điều kiện bảo quản</label>  </div>  <div style="width: 178px;"id="lbempty" class="form-control-label">   <label class="form-control-label"></label>  </div>  </div>  <div  style="display: flex;">      <div style="width: 110%"class="form-group"><input type="text" name="vitri[]" value="" placeholder="Vị trí đặt"class="form-control" required> </div>  <div style="width: 110%"class="form-group"> <input type="text" name="chuy[]" value="" placeholder="Chú ý"class="form-control" >  </div>  <div style="width: 110%"class="form-group">   <input type="text" value="" name="dkbq[]" placeholder="Điều kiện bảo quản"class="form-control" >  </div>    <div class="form-group">  <div style="background-color: #fff;cursor: none;border: 1px solid #fff" id="add_fields" class="add_fields input-group-addon"><i style="color: white"class="fa fa-plus-square"></i></div> </div></div> <div  style="display: flex;">  <div style="width: 82%;" id="lbform" class="form-control-label"> <label  class="form-control-label">Ngày hết hạn</label>  </div>  <div style="width: 85%;"id="lbform" class="form-control-label">  <label class="form-control-label">Ngày mở nắp</label>  </div> <div style="width: 85%;" id="lbform" class="form-control-label">   <label class="form-control-label">Số ngày hết hạn</label>  </div> <div style="width: 95%;"id="lbform" class="form-control-label">  <label class="form-control-label">Hình ảnh</label>  </div> </div> <div  style="display: flex;">  <div style="width: 110%"class="form-group">  <input type="date" name="ngayhethan[]" value="" placeholder="Ngày hết hạn"class="form-control" >  </div> <div style="width: 110%"class="form-group"> <input type="date" value="" name="ngaymonap[]" placeholder="Ngày mở nắp"class="form-control" >  </div>  <div style="width: 110%"class="form-group"><input type="text" value="" name="songayhethan[]" placeholder="Số ngày hết hạn"class="form-control" > </div>  <div style="width: 110%"class="form-group">  <input type="file" style="border: none"  name="hinhanh[]"  class="form-control" > </div> <div style="background-color: #fff;cursor: none;border: 1px solid #fff" id="add_fields" class="add_fields input-group-addon"><i style="color: white"class="fa fa-plus-square"></i></div></div> <a style="display:table;margin: 0 auto;" href="javascript:void(0);" class="remove_field"><button><i class="fa fa-minus-square"></i></button></a></button></div></div>');
}
});
//when user click on remove button
$(wrapper).on("click",".remove_field", function(e){
e.preventDefault();
$(this).parent('div').remove(); //remove inout field
x--;
})
});
</script>