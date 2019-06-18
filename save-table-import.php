<?php


include('cn.php');

if(isset($_POST['hidden_id']))
{
 $TenVatTu = $_POST['TenVatTu'];
 $DVT = $_POST['DVT'];
 $SL = $_POST['SL'];
 $ThongSoKT = $_POST['ThongSoKT'];
 $XuatXu = $_POST['XuatXu'];
 $GhiChu = $_POST['GhiChu'];

 $id = $_POST['hidden_id'];
 for($count = 0; $count < count($id); $count++)
 {
  $data = array(
   ':TenVatTu'   => $TenVatTu[$count],
   ':DVT'   => $DVT[$count],
   ':SL'   => $SL[$count],
   ':ThongSoKT'  => $ThongSoKT[$count],
   ':XuatXu'  => $XuatXu[$count],
   ':GhiChu'  => $GhiChu[$count],
   ':id'   => $id[$count]
 );
  $query = "
  UPDATE tblphieuyeucautrangbi 
  SET TenVatTu = :TenVatTu, DVT = :DVT, SL = :SL, ThongSoKT = :ThongSoKT, XuatXu = :XuatXu, GhiChu = :GhiChu
  WHERE STT = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
}
}

?>

