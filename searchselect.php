<?php
//select.php
include('cn.php');
$searchTerm = $_GET['searchString'];
$query = "SELECT * FROM tblhoachat where TrangThai = 1 and TenHoaChat LIKE '%".$searchTerm."%'";
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