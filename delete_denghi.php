<?php
include('connect/myconnect.php');
	$id=$_GET['id'];
	$query="SELECT * FROM tblhoachat WHERE id=$id ";
	$result=mysqli_query($connect,$query);
	$hoachat=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$query1="SELECT * FROM tbldungcutn WHERE MaDungCu=$id ";
	$result1=mysqli_query($connect,$query1);
	$dungcu=mysqli_fetch_array($result1,MYSQLI_ASSOC);
	
	if($id==$dungcu['MaDungCu'])
	{
		$query_tn="DELETE FROM tbldungcutn  WHERE MaDungCu=$id";
		$result_tn=mysqli_query($connect,$query_tn);
		header('Location:list_choduyet.php');
	}
	if($id==$hoachat['id'])
	{
		$query_hc="DELETE FROM tblhoachat  WHERE id=$id";
		$result_hc=mysqli_query($connect,$query_hc);
		header('Location:list_choduyet.php');
	}
?>