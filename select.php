<?php
//select.php
include('cn.php');
$query = "SELECT * FROM tblhoachat WHERE TrangThai = 1 ORDER BY id";
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