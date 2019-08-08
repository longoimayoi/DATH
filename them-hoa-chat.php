<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');
include('connect/function.php');
?>
<style type="text/css">
  .required{
    color: red;
  }
</style>
<?php
include 'leftpanel.php' ;?>
<?php
 date_default_timezone_set('Asia/Ho_Chi_Minh');
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
        $index = 2;
        $cells = $row->getElementsByTagName('Cell');
        foreach ($cells as $cell)
        {
          $ind = $cell->getAttribute('Index');
          if($ind != null) $index = $ind;
          if($index == 2)
            $mavt = $cell->nodeValue;
          if($index == 3)
            $tenhc = $cell->nodeValue;
          if($index == 4)
            $dvt = $cell->nodeValue;
          if($index == 5)
            $slt = $cell->nodeValue;
          if($index == 6)
            $vitri = $cell->nodeValue;
          if($index == 7)
            $chuy = $cell->nodeValue;
          if($index == 8)
            $dkbq = $cell->nodeValue;
          if($index == 9)
            $ngayhethan = $cell->nodeValue;
          if($index == 10)
            $ngaymonap = $cell->nodeValue;
          if($index == 11)
            $songayhethan = $cell->nodeValue;
          if($index == 12)
            $thongso = $cell->nodeValue;
          if($index == 13)
            $xuatxu = $cell->nodeValue;
          $index++;
        }
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
          'SoNgayHetHanSMN'  =>$songayhethan,
          'ThongSoKT'  =>$thongso,
          'XuatXu'  =>$xuatxu
        );
      }
      $first_row = false;
    }
  }
  if($data)
  {
//               echo "<pre>";
//       print_r($data);
// echo "</pre>";
    $dem_tt=1;
    foreach ($data as $row)
    {
      if($dem_tt>1)
      {
date_default_timezone_set('Asia/Ho_Chi_Minh');
$today=date("Y-m-d H:i:s");

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
        $a11=$row['ThongSoKT'];
        $a12=$row['XuatXu'];
        $trangthai=1;
        $query="INSERT INTO tblhoachat(MaVatTu,TenHoaChat,DVT,SLT,ViTriDat,ChuY,DieuKienBaoQuan,NgayHetHan,NgayMoNap,SoNgayHetHanSMN,ThongSoKT,XuatXu,TrangThai)
        VALUES('$a1','$a2','$a3',$a4,'$a5','$a6','$a7','$a8','$a9',$a10,'$a11','$a12',$trangthai)";
        $results=mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
         
          }
            $dem_tt++;
          }
          if(mysqli_affected_rows($connect)==1)
        {
          echo  "<script type='text/javascript'>alert('import hóa chất thành công');</script>";
          echo("<script>location.href = '"."danh-sach-hoa-chat.php';</script>");
        }
        else
        {
          echo "<script>alert('ERROR')</script>";
        }
         
  }
}

?>
<?php
if(isset($_POST['submit']))
{
  $danhmuc=$_POST['danhmuc'];
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
  $thongso=$_POST['thongso'];
  $xuatxu=$_POST['xuatxu'];
  if(isset($_POST['ngayhethan']))
  {
    $ngayhethan=$_POST['ngayhethan'];
  }
  else
  {
    $ngayhethan='0000-00-00';
  }
  if(isset($_POST['songayhethan']))
  {
    $songayhethan=$_POST['songayhethan'];
  }
  else
  {
    $songayhethan=" ";
  }
  if(isset($_POST['ngaymonap']))
  {
    $ngaymonap=$_POST['ngaymonap'];
  }
  else
  {
    $ngaymonap='0000-00-00';
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
// $hinhanh1= '';
// if($hinhanh != null){
//   $hinhanh1 = $hinhanh;
// }
    foreach ($tenhc as $k => $v)
    {
      $query="INSERT INTO tblhoachat(TenHoaChat,MaDanhMuc,MaVatTu,SLT,DVT,ChuY,ViTriDat,DieuKienBaoQuan,NgayHetHan,NgayMoNap ,SoNgayHetHanSMN,HinhAnh,ThongSoKT,XuatXu,TrangThai) VALUES
      ('$v','$danhmuc','$mavt[$k]','$slt[$k]','$dvt[$k]','$chuy[$k]','$vitri[$k]','$dkbq[$k]','$ngayhethan[$k]','$ngaymonap[$k]','$songayhethan[$k]','$hinhanh[$k]','$thongso[$k]','$xuatxu[$k]',$trangthai)";
      $result=mysqli_query($connect,$query)or die("Query_id {$query} \n <br> MySql erros:".mysqli_errno($connect));
    }
    if(mysqli_affected_rows($connect)>0)
    {
      echo "<script>alert('Thêm thành công')</script>";
      echo("<script>location.href = '"."them-hoa-chat.php';</script>");
    }
    else
    {
      echo "<script>alert('Thêm không thành công')</script>";
      echo("<script>location.href = '"."them-hoa-chat.php';</script>");
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
<div class="col-lg-12" style="">

  <div style="float: right;margin-right: 20px;display: flex">
   <a style="float:left;" href = "template/file-them-vat-tu.xml" download><button type="submit" name="taiFileMau">Tải file mẫu</button></a>
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
            <form action="" method="POST" enctype="multipart/form-data" >
              <div class="form-group">
                <?php hienthi('danhmuc','form-control') ?>
              </div>
              <div class="card-body card-block">

                <div class="wrapper">
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label for="">Mã vật tư:</label>
                      <input name="mavt[]" class="form-control" type="text" required>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Tên vật tư:</label>
                      <input name="tenhc[]" class="form-control"  type="text" required>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Đơn vị tính:</label>
                      <input name="dvt[]"  class="form-control" type="text">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Số lượng:</label>
                      <input name="slt[]" class="form-control"  type="number" required>
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Thông số kĩ thuật:</label>
                      <input class="form-control" name="thongso[]" type="text">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Xuất xứ:</label>
                      <input class="form-control" name="xuatxu[]" type="text">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Vị trí đặt:</label>
                      <input  name="vitri[]" class="form-control"  type="text">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Chú ý:</label>
                      <input name="chuy[]"  class="form-control"  type="text">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Điều kiện bảo quản:</label>
                      <input name="dkbq[]" class="form-control"  type="text">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Ngày hết hạn:</label>
                      <input  name="ngayhethan[]"  placeholder="Định dạng:  MM/DD/YYYY" class="form-control"  type="date">
                    </div>
                    
                    <div class="form-group col-lg-3">
                      <label for="">Ngày mở nắp:</label>
                      <input name="ngaymonap[]" placeholder="Định dạng:  MM/DD/YYYY" class="form-control" type="date">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Số ngày hết hạn sau mở nắp:</label>
                      <input name="songayhethan[]" class="form-control"  type="text">
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="">Hình ảnh:</label>
                      <input name="hinhanh[]" style="border: none"class="form-control"  type="file">
                    </div>
                    <div class="form-group col-lg-3">
                      <div style="margin-top: 30px;width: 100px;" id="add_fields" class="add_fields input-group-addon"><i class="ti-plus"></i></div>
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
                <!--                 <br> -->

              </div>
            </form>
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
  $(wrapper).append('<div> <div> <div><span><hr style="border:1.5px solid #007bff61; border-style:dashed"><span></div> <div class="row"> <div class="form-group col-lg-3"> <label for="">Mã vật tư:</label> <input name="mavt[]" class="form-control" type="text" required> </div><div class="form-group col-lg-3"> <label for="">Tên vật tư:</label> <input name="tenhc[]" class="form-control"  type="text" required> </div> <div class="form-group col-lg-3">  <label for="">Đơn vị tính:</label><input name="dvt[]"  class="form-control" type="text"> </div>  <div class="form-group col-lg-3"> <label for="">Số lượng:</label>  <input name="slt[]" class="form-control"  type="number" required>  </div><div class="form-group col-lg-3">  <label for="">Thông số kĩ thuật:</label> <input class="form-control"  type="text"> </div>  <div class="form-group col-lg-3"><label for="">Xuất xứ:</label>  <input class="form-control"  type="text"> </div><div class="form-group col-lg-3"> <label for="">Vị trí đặt:</label> <input  name="vitri[]" class="form-control"  type="text"> </div>  <div class="form-group col-lg-3"> <label for="">Chú ý:</label> <input name="chuy[]"  class="form-control"  type="text"> </div> <div class="form-group col-lg-3"> <label for="">Điều kiện bảo quản:</label>  <input name="dkbq[]" class="form-control"  type="text"> </div>  <div class="form-group col-lg-3">  <label for="">Ngày hết hạn:</label> <input  name="ngayhethan[]"  class="form-control" type="date"> </div> <div class="form-group col-lg-3"> <label for="">Ngày mở nắp:</label>  <input name="ngaymonap[]" placeholder="Định dạng:  MM/DD/YYYY" class="form-control" id="datepicker2" type="date"> </div>  <div class="form-group col-lg-3"> <label for="">Số ngày hết hạn sau mở nắp:</label>  <input name="songayhethan[]" class="form-control"  type="text"> </div>  <div class="form-group col-lg-3"> <label for="">Hình ảnh:</label> <input name="hinhanh[]" style="border: none"class="form-control"  type="file"></div>  </div>  <a style="display:table;margin: 0 auto;" href="javascript:void(0);" class="remove_field"> <div style="margin-top: 30px;width: 100px;" class="add_fields input-group-addon"><i class="ti-minus"></i></div></a><hr style="border:1.5px solid #007bff61; border-style:dashed"></div></div>');
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
<script>
  $( function() {
    $( ".form-control1").datepicker();
  } );
</script>
<script>
  $( function() {
    $( "#datepicker2" ).datepicker();
  } );
</script>