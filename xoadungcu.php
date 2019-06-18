<?php
include('cn.php');
if(isset($_POST['hidden_id']))
{
$id = $_POST['hidden_id'];
for($count = 0; $count < count($id); $count++)
{
$data = array(
':MaDungCu'   => $id[$count]
);
$query = "
DELETE FROM tbldungcutn
WHERE MaDungCu = :MaDungCu
";
$statement = $connect->prepare($query);
$statement->execute($data);
}
}
?>