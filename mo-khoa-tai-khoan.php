<?php 
include('connect/myconnect.php');
if(isset($_POST['mokhoa']))
{
	$id=$_GET['id'];
    $lydo=$_POST['lydo'];
    $sql1 = "UPDATE tbltaikhoan set TrangThai=1, Lydo='$lydo' WHERE MaTK=".$id."";
    $query = mysqli_query($connect,$sql1);
    if(mysqli_affected_rows($connect)==1)   
       {
          echo "<script>alert('Mở khóa tài khoản thành công')</script>";
          echo("<script>location.href = '"."danh-sach-tai-khoan.php';</script>");
        }
}
 ?>