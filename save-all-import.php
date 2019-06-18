<?php
include('connect/myconnect.php');
$MaHD=$_GET['MaHD'];
/* $query="SELECT * FROM tblphieuyeucautrangbi WHERE MaHD='$MaHD' ";
$result=mysqli_query($connect,$query);
while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	$query_id="UPDATE tblphieuyeucautrangbi SET TrangThai=0 WHERE STT=".$row['STT']."";
	$result_id=mysqli_query($connect,$query_id);
}*/
header('Location:chitiet-phieu-yeu-cau-trangbi.php?MaHD='.$MaHD.'');
?>