<style>
.check{
display: none;
}

</style>
<?php include ('header.php');
include('connect/myconnect.php');
include('connect/function.php');
include ('leftpanel.php') ;
$id=$_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$TenDangNhap = $_POST["TenDangNhap"];
$HoTen = $_POST["HoTen"];
$SDT = $_POST["SDT"];
$khoa=$_POST['khoa'];
if(isset($_POST['lydo']))
{
$lydo=$_POST['lydo'];
}
else
{
$lydo="";
}
if(isset($_POST['password']))
{
$password = md5($_POST["password"]);
}
if(isset($_POST['check']))
{
$quyen=$_POST["check"];
$imp=implode(",",$quyen);
}
else
{
$imp=" ";
}
if(isset($_POST['changepassword']))
{

$sql1 = "UPDATE tbltaikhoan set  MaKhoa='$khoa', MaQH='$imp',TenDangNhap='$TenDangNhap',HoTen='$HoTen',SDT='$SDT',MatKhau='$password' WHERE MaTK=$id";
$query = mysqli_query($connect,$sql1);
if(mysqli_affected_rows($connect)==1)
{
echo "<script>alert('Sửa tài khoản thành công')</script>";
}
}
if(isset($_POST['vohieuhoa']))
{

$sql1 = "UPDATE tbltaikhoan set Lydo='$lydo', TrangThai=0 WHERE MaTK=$id";
$query = mysqli_query($connect,$sql1);
if(mysqli_affected_rows($connect)==1)
{
echo "<script>alert('Vô hiệu hóa tài khoản thành công')</script>";
}
}
if(isset($_POST['mokhoa']))
{

$sql1 = "UPDATE tbltaikhoan set Lydo='$lydo', TrangThai=1 WHERE MaTK=$id";
$query = mysqli_query($connect,$sql1);
if(mysqli_affected_rows($connect)==1)
{
echo "<script>alert('Mở khóa tài khoản thành công')</script>";
}
}
else
{
$sql1 = "UPDATE tbltaikhoan set MaKhoa='$khoa', MaQH='$imp',TenDangNhap='$TenDangNhap',HoTen='$HoTen',SDT='$SDT' WHERE MaTK=$id";
$query = mysqli_query($connect,$sql1);
if(mysqli_affected_rows($connect)==1)
{
echo "<script>alert('Sửa tài khoản thành công')</script>";
}
}

}
$query="SELECT TenDangNhap,HoTen,SDT,MatKhau,MaQH,MaKhoa,TrangThai FROM tbltaikhoan WHERE MaTK=$id";
$result=mysqli_query($connect,$query);
$item=mysqli_fetch_array($result);
$a=$item['MaQH'];
$qh=explode(',', $a);
?>
<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-12">
        <div class="card" >
          <div class="card-header">
            <strong>CHI TIẾT TÀI KHOẢN <label for=""><?php echo $item['TenDangNhap'] ?></label></strong>
            <button  style="float: left;background: transparent;color: #ff0000d6;border: 1.65px solid;width: 60px;" type="reset" onclick="goBack()"> <span style="margin-left: -8px"class="ti-arrow-left"></span></button>
            
          </div >
<!--                 <?php if(isset($message)){ ?>
          <div class="alert alert-danger">
            <?php echo  $message ?>
            <?php } else echo ""; ?>
          </div> -->
          <div class="card-body card-block">
            
              <form  method="post" id="formcttk" >
                <input type="hidden" name="form[_token]" value="{{ form._token.vars.value }}" />
                <h2 style="color: red"><?php // if($item['TrangThai']==1) echo "Còn hoạt động"; else echo "Đã bị vô hiệu hóa"; ?></h2>
                <div class="form-group" >
                  <label for="" >Tên đăng nhập</label>
                  <input type="text" placeholder="Tên đăng nhập" id="TenDangNhap" value="<?php echo $item['TenDangNhap'] ?>" name="TenDangNhap" required="" class="form-control" >
                  <p id="validate-user"></p>
                </div>
                <div class="form-group" >
                  <label for="" >Họ tên</label>
                  <input type="text" placeholder="Họ tên" value="<?php echo $item['HoTen'] ?>" name="HoTen" class=" form-control">
                </div>
                <div class=" form-group">
                  <label class=" form-control-label">Khoa</label>
                  <select class="form-control" name="khoa" id="">
                    <?php $query="SELECT * FROM tblkhoa";
                    $result=mysqli_query($connect,$query);
                    while ($item1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    ?>
                    <option
                      <?php if($item['MaKhoa']==$item1['MaKhoa'])
                      echo 'selected="selected"';
                      ?>
                    value="<?php echo $item1['MaKhoa'] ?>"><?php echo $item1['TenKhoa'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group" >
                  <label for="" >Số điện thoại</label>
                  <input type="number" placeholder="Số điện thoại"  maxlength = "10" value="<?php echo $item["SDT"]; ?>" name="SDT" class="form-control">
                </div>
                <div style="border-bottom:1px solid #d3d3d3;margin-bottom: 10px;display: flex;">
                  <div style="display: flex;float: left;">
                    <label for="" >Đổi mật khẩu</label>&nbsp;
                    <input style="margin-top: 5px;" type="checkbox" id="checkchangepassword" name="changepassword">
                  </div>
                  <div style="float:right;;">
                  <?php if($item['TrangThai']==1) {?>
                  <div style="margin-left: 926px">
                    <label for="" >Vô hiệu hóa</label>
                    <input type="checkbox" id="checkvohieuhoa" name="vohieuhoa">
                  </div>
                  <?php } else { ?>
                  <div style="margin-left: 926px">
                    <label for="" >Mở khóa</label>
                    <input type="checkbox" id="checkmokhoa" name="mokhoa">
                  </div>
                  <?php } ?>
                </div>
                </div>
                <div id="checkpass" class="check">
                  <div class="form-group" >
                    <label for="" >Mật khẩu</label>
                    <input type="password" placeholder="Mật khẩu" value="<?php echo $item['MatKhau'] ?>" name="password" id="password" required="" class="form-control password" disabled="">
                  </div>
                  <div class="form-group" >
                    <label for="" >Xác nhận mật khẩu</label>
                    <input type="password" placeholder="Xác nhận mật khẩu" value="<?php echo $item['MatKhau'] ?>" name="confirm"  required=""class="form-control password" disabled="">
                  </div>
                </div>
                
                <div id="checkvohieu" class="check">
                  <div class="form-group" >
                    <label for="" >Lý do vô hiệu hóa</label>
                    <input type="text" placeholder="Lý do vô hiệu hóa" name="lydo" class="form-control vohieu" disabled="">
                  </div>
                </div>
                <div id="checkmo" class="check">
                  <div class="form-group" >
                    <label for="" >Lý do mở khóa</label>
                    <input type="text" placeholder="Lý do mở khóa" name="lydo" class="form-control mokhoa" disabled="">
                  </div>
                </div>
                <div class="row"  >
                  <?php  $sql = "SELECT * FROM tblquyenhan ORDER BY TenQH";
                  $query = mysqli_query($connect, $sql);
                  while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
                  {
                  ?>
                  <div class="col-lg-6" >
                    <input class="checkbox" style="float:right;"  type="checkbox" value="<?php  echo $row['MaQH'] ?>" name="check[]" <?php
                    if(in_array($row["MaQH"],$qh))
                    {
                    echo "checked";
                    }
                    ?> />
                    <label  >
                      <?php echo $row['TenQH']; ?>
                    </label>
                  </div>
                  <?php } ?>
                </div>
                <div class="submit" style="float: right;margin-right: 1px">
                  <button type="submit" name="submit" >
                  Lưu
                  </button>
                </div>
              </form>
            </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'scriptindex.php'; ?>
   <script src="assets/js/my.js"></script>  
<script src="assets/js/jquery-3.2.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
</html>
<script>
function goBack() {
window.history.back();
}
</script>