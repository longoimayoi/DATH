<style>
  .hidden{
    display: none;
  }
</style>
<?php include 'header.php';
include('connect/myconnect.php');
include 'leftpanel.php' ;
$MaHD=$_GET['MaHD'];
$i=1;
if(isset($_POST['submit']))
  {
    $tenvt=$_POST['tenvt'];
    $sl=$_POST['sl'];
    $dvtinh=$_POST['dvtinh'];
    $thongso=$_POST['thongso'];
    $xuatxu=$_POST['xuatxu'];
    $ghichu=$_POST['ghichu'];
    $dongia=0;
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
        $query="INSERT INTO tblphieuyeucautrangbi(MaHD,TenVatTu,DVT,SL,ThongSoKT,XuatXu,GhiChu,DonGia) VALUES
        ($MaHD,'$v','$dvtinh[$k]','$sl[$k]','$thongso[$k]','$xuatxu[$k]','$ghichu[$k]',0)";
        $result=mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
      }
      if(mysqli_affected_rows($connect)==1)
      {
        $query_up="UPDATE tblhoadon set TrangThai=5 WHERE MaHD='$MaHD'";
        $result_up=mysqli_query($connect,$query_up);
        echo "<script>alert('Thêm chi tiết thành công')</script>";
          echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=$MaHD';</script>");
      }
      else
      {
        echo "<script>alert('Lập phiếu không thành công')</script>";
      }
      
      
    }
  }
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
          $dongia=0;
          $matk=$_SESSION['uid'];
          $a1=$row['TenVatTu'];
          $a2=$row['DVT'];
          $a3=$row['SL'];
          $a4=$row['ThongSoKT'];
          $a5=$row['XuatXu'];
          $a6=$row['GhiChu'];
          $query="INSERT INTO tblphieuyeucautrangbi(MaHD,TenVatTu,DVT,SL,DonGia,ThongSoKT,XuatXu,GhiChu)
          VALUES($MaHD,'{$a1}','{$a2}',$a3,$dongia,'$a4','$a5','$a6')";
          $results=mysqli_query($connect,$query);
        }
        $dem_tt++;
      }
      $query_up="UPDATE tblhoadon set TrangThai=5 WHERE MaHD='$MaHD'";
        $result_up=mysqli_query($connect,$query_up);
      echo("<script>location.href = '"."show-table-phieu-import.php?MaHD=$MaHD';</script>");
    }
  }
 $query1="SELECT /*TenDeXuat,*/MonHoc,NhomLop,MaKhoa,HocKy,TrangThai FROM tblhoadon WHERE MaHD='$MaHD' ";
        $result1=mysqli_query($connect,$query1);
       list(/*$TDX,*/$MonHoc,$NhomLop,$Khoa,$HocKy,$TrangThai)=mysqli_fetch_array($result1,MYSQLI_NUM);


$query_c="SELECT COUNT(DonGia) as SL FROM  tblphieuyeucautrangbi WHERE MaHD=$MaHD AND DonGia =0";
$result_c=mysqli_query($connect,$query_c);
list($SL)=mysqli_fetch_array($result_c,MYSQLI_NUM);
if(isset($_POST['edit']))
{
   date_default_timezone_set('Asia/Ho_Chi_Minh');
    $ngaycn=date("Y-m-d H:i:s");
  /*$TDX1=$_POST['TDX'];*/
  $MonHoc1=$_POST['MonHoc'];
  $NhomLop1=$_POST['NhomLop'];
  $khoa1=$_POST['khoa'];
  $HocKy1=$_POST['HocKy'];
  $query_tt="UPDATE tblhoadon SET MonHoc='$MonHoc1',NhomLop='$NhomLop1',MaKhoa='$khoa1',HocKy='$HocKy1',NgayCapNhat='$ngaycn' WHERE MaHD=$MaHD";
  $result_tt=mysqli_query($connect,$query_tt);
  if(mysqli_affected_rows($connect)==1)
      {
         echo  "<script type='text/javascript'>alert('Sửa thông tin phiếu đề xuất thành công');</script>";
          echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=$MaHD';</script>");
        
      }
      else
      {
        echo "<script>alert('Sửa thông tin phiếu đề xuất không thành công')</script>";
      }
}
if(isset($_POST['huy']))
{
  include('huy-phieu-yeu-cau-trangbi.php');
}

if(isset($_POST['guiphieu']))
{
  $query_g="UPDATE tblhoadon set TrangThai=0 WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
      {
         echo  "<script type='text/javascript'>alert('Gửi phiếu đề xuất thành công');</script>";
          echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");
        
      }
    
}
?>

 <button type="reset" onclick="window.location.href='danhsach-phieu-yeu-cau-trangbi.php'">Trở lại</button>
<div class="container">
  <h2 style="color: black">Phiếu yêu cầu trang bị vật tư</h2>
  <hr>
  <br />
  <form action="" method="post">
   <div class="row form-group" id="checkopenedit">
      <!-- <div class="col-lg-6">
        <label for="">Tên đề xuất</label>
        <input class="form-control edit" type="text" name="TDX" value="<?php echo $TDX; ?>" disabled="">
      </div> -->
      <div class="form-group col-lg-6">
        <label for="">Môn học</label>
        <input class="form-control edit" type="text" name="MonHoc" value="<?php echo $MonHoc; ?>" disabled="">
      </div>
      <div class="form-group  col-lg-6">
        <label for="">Nhóm lớp</label>
        <input class="form-control edit" type="text" name="NhomLop" value="<?php echo $NhomLop; ?>" disabled="">
      </div>
      <div class="form-group  col-lg-6">
         <label for="">Khoa</label>
        <select class="form-control edit" name="khoa" id="" disabled="">
          <?php $query="SELECT * FROM tblkhoa";
                  $result=mysqli_query($connect,$query);
                  while ($item1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      ?>
                      <option 
                      <?php if($Khoa==$item1['MaKhoa'])
                        echo 'selected="selected"';
                       ?>
                      value="<?php echo $item1['MaKhoa'] ?>"><?php echo $item1['TenKhoa'] ?></option>
                      <?php
                  }
           ?>
           </select>
      </div>
      <div class="form-group  col-lg-6">
        <label for="">Học kỳ</label>
         <select class="form-control edit" name="HocKy" id="" disabled="">
          <?php $query="SELECT * FROM tblhocky";
                  $result=mysqli_query($connect,$query);
                  while ($item1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                      ?>
                      <option 
                      <?php if($HocKy==$item1['MaHK'])
                        echo 'selected="selected"';
                       ?>
                      value="<?php echo $item1['MaHK'] ?>"><?php echo $item1['TenHK'] ?></option>
                      <?php
                  }
           ?>
           </select>
       
      </div>
      <div class="form-group  col-lg-6 edit">
        <label for="">Tình trạng</label>
       <br>
        
        <?php 
        if($TrangThai==0){?>
       <span class="badge badge-pill badge-primary">Chờ báo giá </span>
       
          <?php }if($TrangThai==1) { ?>
         <span class="badge badge-pill badge-warning">Chờ duyệt</span>
 
          <?php } if($TrangThai==2) {?>
         <span class="badge badge-pill badge-success">Đã duyệt</span>
        <?php  }if($TrangThai==4) {?>
             <span style="width: 150px" class="badge badge-pill badge-danger">Phiếu đã bị hủy</span>
            <?php  }if($TrangThai==5) {?>
            <span style="width: 150px" class="badge badge-pill badge-danger">Chờ thêm vật tư</span>
               <label for="">Sửa thông tin đề xuất</label>
         <input type="checkbox" id="checkedit" name="edit">
         <button  style="background-color: #217346" type="submit" name="edit" id="show" class="hidden">Sửa</button>
          <?php } ?>
          
         
      
      
      </div>
      
    </div>
    </form>
  <div class="table-responsive" >
    <?php if($TrangThai==0) { ?>
       <div>
              <form name='import' method="POST" enctype="multipart/form-data">
              <div class="submit" style="float: left;margin-right: 1px">
             <!--    <button  style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"></i> Import</button> -->
                <input data-toggle="collapse" href="#collapse" class="collapsed" id="file-upload" type="file" name="file" multiple style='display: none;'>
                <button id="collapse" class="panel-collapse collapse" type="submit" name="import">Nhập excel</button>
              </div>
             </form>
             <div style="float:right;">
                 <input type="button" id="savedl" onclick="window.location.href='cap-nhat-chi-tiet-phieu-ycvt.php?MaHD=<?php echo $MaHD ?>'" value="Báo giá [<?php echo $SL; ?>]"/> 
             </div>
        <!-- 
            <input type="button" style="background-color: #ff0000d6;float: right;" data-toggle="modal" data-target="#myModal" value="Hủy đơn"/> -->

          </div>
             <?php } elseif($TrangThai ==5) {?>
      <div>
             <form name='import' method="POST" enctype="multipart/form-data">
              <div class="submit" style="float: left;margin-right: 1px">
                <button  style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"></i> Import</button>
                <input data-toggle="collapse" href="#collapse" class="collapsed" id="file-upload" type="file" name="file" multiple style='display: none;'>
                <button id="collapse" class="panel-collapse collapse" type="submit" name="import">Nhập excel</button>
            
              </div>
             </form>
             <?php if($SL >0) {?>
             <form action="" method="post">
                   <button  style="float: right;" type="submit" name="guiphieu"  >Gửi phiếu</button>
             </form>
               <input style="float:right;"  type="button" id="savedl" onclick="window.location.href='cap-nhat-table-import.php?MaHD=<?php echo $MaHD ?>'" value="Chỉnh sửa chi tiết đề xuất"/>
           <?php } ?>
            <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">Thêm chi tiết</button>
            <!--  <input type="button" style="background-color: #ff0000d6;float: right;" onclick="window.location.href='huy-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $MaHD ?>'" value="Hủy đơn"/> -->
            <input type="button" style="background-color: #ff0000d6;float: right;" data-toggle="modal" data-target="#myModal" value="Hủy phiếu"/>
           
          </div>
           <?php }  elseif($TrangThai==1) {?>
             <div id="row" >
        <div class="submit" style="float: right;margin-right: 1px">
          <input type="button" onclick="window.location.href='duyet-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $MaHD ?>'" value="Duyệt phiếu"/>
          <input type="button" style="background-color: #ff0000d6;float: right;" data-toggle="modal" data-target="#myModal" value="Hủy phiếu"/>
        </div>
      </div>
   
    <?php }else echo ""; ?>
       
        <div  class="content mt-3 " style="padding: 0;">
      <div class="animated fadeIn">
        <div class="row">
          <div id="collapse1" class="col-lg-12 panel-collapse collapse">
            
            <div class="card" >
              
              <div class="card-header">
                
                <strong>Thêm chi tiết yêu cầu vật tư</strong>
              </div >
              
              
              
              
              <div class="card-body card-block">
                
                
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
                        <input type="text" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư"class="form-control" required>
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
                        <input type="text" value="" name="ghichu[]" placeholder="Ghi chú"class="form-control" required>
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
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 600px;">
            <div class="modal-body modal-body-sub_agile">
                <div class="card-body card-block">
                    <h3 style="text-align: center;" class="agileinfo_sign">Hủy phiếu yêu cầu trang bị</h3>
                    <p style="width: 50px;"></p>
                    <form action="" method="post"  >
                        <div class=" form-group">
                            <input type="text" placeholder="Nhập lý do hủy" name="LyDoHuy" class="form-control">
                        </div>
                        <button class="btn btn-outline-danger" style="float:right;"type="submit" name="huy">Hủy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
     <div style="float:left;display: flex;width: 100%;">
      <br>
      
      <table class="table table-bordered table-striped" style="">
          <thead>
            <th>STT</th>
            <th width="">Tên Vật tư</th>
            <th width="">Đơn vị tính</th>
            <th width="">Số lượng</th>
            <th width="">Đơn giá</th>
            <th width="">Thành tiền</th>
            <th width="">Ghi chú</th>
          </thead>
          <?php $query="SELECT * FROM tblphieuyeucautrangbi WHERE MaHD='$MaHD'";
          $result=mysqli_query($connect,$query);
          while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
           
          ?>
          <tbody>
            
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['TenVatTu'] ?></td>
            <td><?php echo $row['DVT'] ?></td>
            <td><?php echo $row['SL'] ?></td>
            <td><?php echo $row['DonGia'] ?></td>
            <td><?php echo $row['DonGia']*$row['SL'] ?></td>
            <td><?php echo $row['GhiChu'] ?></td>
            
          </tbody>
          <?php  } ?>
        </table>

       <br>
     
      
    </div>

  </div>
    
</div>
<?php include 'scriptindex.php'; ?>
  <script src="assets/js/jquery-3.2.1.min.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>  
</body>
</html>
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
  $(wrapper).append('<div> <div  style="display: flex;"> <div style="width: 110%"class="form-group"><input type="text" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư"class="form-control" required> </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="dvtinh[]" placeholder="Đơn vị tính"class="form-control" required> </div>  <div style="width: 110%"class="form-group"> <input type="number" value="" name="sl[]" placeholder="Số lượng "class="form-control" required> </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="thongso[]" placeholder="Thông số kỹ thuật"class="form-control" >  </div> <div style="width: 110%"class="form-group">  <input type="text" value="" name="xuatxu[]" placeholder="Xuất xứ"class="form-control" > </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="ghichu[]" placeholder="Ghi chú"class="form-control" required>  </div>  <a href="javascript:void(0);" class="remove_field"><div class="input-group-addon"><i class="fa fa-minus-square"></i></div></a></div></div>');
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
<script>
     function goBack() {
      window.history.back();
    }
</script>