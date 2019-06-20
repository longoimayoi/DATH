<?php
//select.php
include('cn.php');
$query = "SELECT MaDungCu, TenDungCu, ChatLieu, QuyCach, DVT, SLT FROM tbldungcutn ORDER BY MaDungCu";
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