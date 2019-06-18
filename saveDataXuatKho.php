<?php
include('cn.php');
if(isset($_POST['hidden_id']))
{
 $TenVatTu = $_POST['TenVatTu'];
 $SL = $_POST['SL'];

 $id = $_POST['hidden_id'];
 for($count = 0; $count < count($id); $count++)
 {
  $data = array(
   ':TenVatTu'   => $TenVatTu[$count],
   ':SL'   => $SL[$count],
   ':id'   => $id[$count]
 );
  $query = "
  UPDATE ctphieuxuatkho 
  SET TenVT = :TenVatTu, SL = :SL
  WHERE STT = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
}
}

?>

