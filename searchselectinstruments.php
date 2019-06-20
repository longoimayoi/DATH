<?php
//select.php
include('cn.php');
$searchTerm = $_GET['searchString'];
$query = "SELECT MaDungCu, TenDungCu, DVT, ChatLieu, QuyCach,SLT FROM tbldungcutn where TenDungCu LIKE '%".$searchTerm."%'";
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