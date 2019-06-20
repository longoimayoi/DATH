
<?php


include('cn.php');

 $MaHD=$_GET['MaHD'];
$query = "SELECT * FROM tblphieuyeucautrangbi WHERE  MaHD='$MaHD'  ";

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