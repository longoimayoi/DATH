<?php

//multiple_update.php

include('cn.php');

if(isset($_POST['hidden_id']))
{
 $TenHoaChat = $_POST['TenHoaChat'];
  $CongThucHoaHoc = $_POST['CongThucHoaHoc'];
 $SLT = $_POST['SLT'];
  $DVT = $_POST['DVT'];
   $NguyHiemChinh = $_POST['NguyHiemChinh'];
  $ChuY = $_POST['ChuY'];
   $ViTriDat = $_POST['ViTriDat'];
  $NoiBaoQuan = $_POST['NoiBaoQuan'];
   $DieuKienBaoQuan = $_POST['DieuKienBaoQuan'];
  $YeuCauKhiSuDung = $_POST['YeuCauKhiSuDung'];
     $NgayMoNap = $_POST['NgayMoNap'];
  $NgayHetHan = $_POST['NgayHetHan'];
   $SoNgayHetHanSMN = $_POST['SoNgayHetHanSMN'];
  $HinhAnh = $_POST['HinhAnh'];
 $id = $_POST['hidden_id'];
 for($count = 0; $count < count($id); $count++)
 {
  $data = array(
   ':TenHoaChat'   => $TenHoaChat[$count],
   ':SLT'  => $SLT[$count],
 ':DVT'  => $DVT[$count],
 ':CongThucHoaHoc'  => $CongThucHoaHoc[$count],
 ':NguyHiemChinh'  => $NguyHiemChinh[$count],
  ':ChuY'  => $ChuY[$count],
 ':ViTriDat'  => $ViTriDat[$count],
  ':NoiBaoQuan'  => $NoiBaoQuan[$count],
 ':DieuKienBaoQuan'  => $DieuKienBaoQuan[$count],
 ':YeuCauKhiSuDung'  => $YeuCauKhiSuDung[$count],
  ':NgayMoNap'  => $NgayMoNap[$count],
  ':NgayHetHan'  => $NgayHetHan[$count],
 ':SoNgayHetHanSMN'  => $SoNgayHetHanSMN[$count],
 ':HinhAnh'  => $HinhAnh[$count],
   ':id'   => $id[$count]
  );
    $query = "
  UPDATE tblhoachat 
  SET TenHoaChat = :TenHoaChat, SLT = :SLT, DVT = :DVT, CongThucHoaHoc = :CongThucHoaHoc,NguyHiemChinh = :NguyHiemChinh,
  ChuY = :ChuY, ViTriDat = :ViTriDat, NoiBaoQuan = :NoiBaoQuan, DieuKienBaoQuan = :DieuKienBaoQuan, YeuCauKhiSuDung = :YeuCauKhiSuDung,
   NgayMoNap = :NgayMoNap, NgayHetHan = :NgayHetHan, SoNgayHetHanSMN = :SoNgayHetHanSMN, HinhAnh = :HinhAnh

  WHERE id = :id
  ";
  $statement = $connect->prepare($query);
  $statement->execute($data);
 }
}

?>

