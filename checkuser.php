<?php 
session_start();
	 include('connect/myconnect.php');
	if(isset($_POST['TenDangNhap']))
	{
		$TenDangNhap=$_POST['TenDangNhap'];
		$query="SELECT * FROM tbltaikhoan WHERE TenDangNhap='$TenDangNhap'";
		$result=mysqli_query($connect,$query);
		$row=mysqli_num_rows($result);
		if($row==1)
		{
			echo 'Tài khoản đã tồn tại';
	
			echo " <script>
			 	$('#them').addClass('themtk');
			 </script>";
			mysqli_close($connect);
		}
		else
		{
			
			echo " <script>
			 	$('#them').removeClass('themtk');
			 </script>";
			echo 'Có thể sử dụng tài khoản này';
		}

	}
 ?>
