<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');
include('connect/function.php');
?>
<style type="text/css">
  .required{
    color: red;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
          date_default_timezone_set('Asia/Ho_Chi_Minh');
          $today=date("Y-m-d H:i:s");
          $trangthai=3;
          $dongia=0;
          $matk=$_SESSION['uid'];
          $a1=$row['TenVatTu'];
          $a2=$row['DVT'];
          $a3=$row['SL'];
          $a4=$row['ThongSoKT'];
          $a5=$row['XuatXu'];
          $a6=$row['GhiChu'];
          $query="INSERT INTO tblphieuyeucautrangbi(MaTK,TenVatTu,DVT,SL,DonGia,ThongSoKT,XuatXu,GhiChu,NgayLapPhieu,TrangThai)
          VALUES($matk,'{$a1}','{$a2}',$a3,$dongia,'$a4','$a5','$a6','$today',$trangthai)";
          $results=mysqli_query($connect,$query);
        }
        $dem_tt++;
      }
      echo("<script>location.href = '"."show-table-phieu-import.php?ngaylap=$today';</script>");
    }
  }
  ?>
  <?php
  if(isset($_POST['submit']))
  {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $tenvt=$_POST['tenvt'];
    $sl=$_POST['sl'];
    $dvtinh=$_POST['dvtinh'];
    $thongso=$_POST['thongso'];
    $xuatxu=$_POST['xuatxu'];
    $ghichu=$_POST['ghichu'];
    $trangthai=0;
    $today=date("Y-m-d H:i:s");
    $matk=$_SESSION['uid'];
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
        $query="INSERT INTO tblphieuyeucautrangbi(MaTK,TenVatTu,DVT,SL,ThongSoKT,XuatXu,GhiChu,NgayLapPhieu,TrangThai) VALUES
        ($matk,'$v','$dvtinh[$k]','$sl[$k]','$thongso[$k]','$xuatxu[$k]','$ghichu[$k]','$today',$trangthai)";
        $result=mysqli_query($connect,$query);
      }
      if(mysqli_affected_rows($connect)==1)
      {
        echo "<script>alert('Lập phiếu thành công')</script>";
        
      }
      else
      {
        echo "<script>alert('Lập phiếu không thành công')</script>";
      }
      
      
    }
  }
  
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div style="float: right;margin-right: 20px">
        <div class="row">
          <form class=".col-md-4 .ml-auto"name='import' method="POST" enctype="multipart/form-data">
            <div id="row" >
              <div class="submit" style="float: right;margin-right: 1px">
                
                <button  style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"></i> Chọn</button>
                <input data-toggle="collapse" href="#collapse" class="collapsed" id="file-upload" type="file" name="file" multiple style='display: none;'>
                <button id="collapse" class="panel-collapse collapse" type="submit" name="import">Nhập excel</button>
              </div>
            </form>
          </div>
        </div >
      </div>
    </div>

    <div class="content mt-3">
      <div class="animated fadeIn">
        <div class="row">
          <div class="col-lg-12">
            
            <div class="card" >
              
              <div class="card-header">
                
                <strong>Lập phiếu yêu cầu vật tư</strong>
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
    
    <?php include 'scriptindex.php'; ?>
    
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
    $(document).ready(function(){
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
});
</script>