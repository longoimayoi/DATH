<?php

include('connect/myconnect.php');
include('cn.php');
$MaHD=$_GET['MaHD'];

if(isset($_POST['hidden_id']))
{
$TenVatTu = $_POST['TenVatTu'];
 $DVT = $_POST['DVT'];
$SL = $_POST['SL'];
 $DonGia = $_POST['DonGia'];
 $ThanhTien = $_POST['ThanhTien'];
$GhiChu = $_POST['GhiChu'];

 $id = $_POST['hidden_id'];
 for($count = 0; $count < count($id); $count++)
 {
  $data = array(
  //':TenVatTu'   => $TenVatTu[$count],
   //':DVT'   => $DVT[$count],
  ':SL'   => $SL[$count],
   ':DonGia'  => $DonGia[$count],
   ':ThanhTien'  => $DonGia[$count]*$SL[$count],
   //':GhiChu'  => $GhiChu[$count],
   ':id'   => $id[$count]
 );
  
  $query = "
  UPDATE tblphieuyeucautrangbi 
  SET /*TenVatTu = :TenVatTu, DVT = :DVT,*/ SL = :SL, DonGia = :DonGia, ThanhTien = :ThanhTien/*, GhiChu = :GhiChu*/
  WHERE STT = :id
  ";

  $statement = $connect->prepare($query);
  $statement->execute($data);
}
}

?>

