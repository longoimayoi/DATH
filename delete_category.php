<?php

include('connect/myconnect.php');
if(isset($_GET['id']))
{
$id=$_GET['id'];
$query="DELETE FROM tbldanhmuc WHERE MaDanhMuc={$id}";
$results=mysqli_query($connect,$query);
header('Location: danh-muc.php');//x? lý chuy?n trang
}
else
{
echo 'loi';
}

?>