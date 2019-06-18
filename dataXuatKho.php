<?php
include('cn.php');

 $id=$_GET['id'];
$query = "SELECT * FROM ctphieuxuatkho WHERE  MaPhieu='$id'  ";

$statement = $connect->prepare($query);

if($statement->execute())
{
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }

 echo json_encode($data);
 
}

?>