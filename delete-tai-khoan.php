<?php 
session_start();
include('connect/myconnect.php');
$id=$_GET['id'];
	$query="DELETE FROM tbltaikhoan WHERE MaTK=$id";
	$result=mysqli_query($connect,$query);
	header('Location:danh-sach-tai-khoan.php');
	$_SESSION['delete'] = "<script>alert('Xóa tài khoản thành công')</script>";
	
 ?> 