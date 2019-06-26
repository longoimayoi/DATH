<?php 

//kết nối vs sql
	$connect=mysqli_connect('localhost','root','','dath');

	if(!$connect)
	{
		echo "kết nối k thành công";

		
	}
	else
	{

		mysqli_set_charset($connect,'utf8');
		

	}
 ?>
