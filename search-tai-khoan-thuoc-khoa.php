<?php 
include('cn.php');

$MaKhoa=$_GET['MaKhoa'];
$query = "SELECT * FROM tbltaikhoan tk, tblkhoa k  WHERE tk.MaKhoa=k.MaKhoa AND  tk.MaKhoa='$MaKhoa'  ";

$statement = $connect->prepare($query);

if($statement->execute())
{
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
if($data != null)
 {
 	echo json_encode($data);
 }
 else
 $data=null;
 
}

?>