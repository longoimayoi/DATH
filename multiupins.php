<?php
//multiple_update.php
include('cn.php');
if(isset($_POST['hidden_id']))
{
$TenDungCu = $_POST['TenDungCu'];
$ChatLieu = $_POST['ChatLieu'];
$QuyCach = $_POST['QuyCach'];
$SLT = $_POST['SLT'];
$DVT = $_POST['DVT'];
$id = $_POST['hidden_id'];
for($count = 0; $count < count($id); $count++)
{
$data = array(
':TenDungCu'   => $TenDungCu[$count],
':ChatLieu'   => $ChatLieu[$count],
':QuyCach'   => $QuyCach[$count],
':SLT'  => $SLT[$count],
':DVT'  => $DVT[$count],
':id'   => $id[$count]
);
$query = "
UPDATE tbldungcutn
SET TenDungCu = :TenDungCu, ChatLieu = :ChatLieu, QuyCach = :QuyCach, SLT = :SLT, DVT = :DVT
WHERE MaDungCu = :id
";
$statement = $connect->prepare($query);
$statement->execute($data);
}
}
?>