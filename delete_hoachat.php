<?php

include('connect/myconnect.php');
if(isset($_GET['id']))
{
$id=$_GET['id'];
$query="DELETE FROM tblhoachat WHERE id={$id}";
$results=mysqli_query($connect,$query);
header ('Location: '.$_SERVER['HTTP_REFERER']);
}
else
{
echo 'loi';
}

?>