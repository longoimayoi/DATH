
<?php
include 'header.php';
include('connect/myconnect.php');
$output= '';
$MaHD = $_GET["MaHD"];
$i=1;
$a=1;
$sql = "SELECT * FROM tblphieuyeucautrangbi as tbl JOIN tblhoadon as hd WHERE hd.MaHD=tbl.MaHD AND tbl.MaHD=$MaHD ORDER BY  STT ASC " ;
$result = mysqli_query($connect,$sql);
$query_tt = "SELECT * FROM tblphieuyeucautrangbi as tbl JOIN tblhoadon as hd WHERE hd.MaHD=tbl.MaHD AND tbl.MaHD=$MaHD GROUP BY TongTien " ;
$result_tt = mysqli_query($connect,$query_tt);
$query = "SELECT * FROM tblhoadon as hd JOIN monhoc as mh WHERE hd.MonHoc=mh.MaMon AND hd.MaHD=$MaHD";
$result_sl = mysqli_query($connect,$query);
$query_k = "SELECT TenKhoa FROM tblhoadon as hd JOIN tblkhoa as k WHERE k.MaKhoa=hd.MaKhoa AND hd.MaHD=$MaHD";
$result_k = mysqli_query($connect,$query_k);
list($TenKhoa)=mysqli_fetch_array($result_k,MYSQLI_NUM);
if(mysqli_num_rows($result)>0)
{
$output .='
<table  id="bootstrap-data-table-export" class="table table-striped table-bordered" bordered="1">
  <tr>
    <th>TRƯỜNG ĐẠI HỌC CÔNG NGHỆ TP.HCM</th>
    <th></th>
    <th>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</th>
  </tr>
   <tr>
    <th>'.$TenKhoa.'</th>
    <th><th>
    <th>Độc lập - Tự do - Hạnh phúc</th>
  </tr>
  <tr>
    <th></th>
    <th>Số:                  /YC-KD</th>
  </tr>
  <tr>
    <th></th>
    <th>PHIẾU YÊU CẦU TRANG BỊ</th>
  </tr>
   <tr>
    <th></th>
  <th>(V/v Cung cấp vật tư, trang thiết bị, nâng cấp tài sản)</th>
  </tr>
     <tr>
    <th></th>
    <th></th>
    <th>Kính gửi:</th>
    <th>Ban giám hiệu</th>
  </tr>
  </tr>
     <tr>
    <th></th>
    <th></th>
    <th></th>
    <th>Phòng Quản trị</th>
  </tr>

<tr><th>I. Đề xuất:</th></tr>
<tr><th>Đơn vị yêu cầu: '.$TenKhoa.'</th></tr>
<tr><th>Lý do: Mua hóa chất phục vụ thí nghiệm môn SHPT-Hóa sinh 1</th></tr>
<tr></tr>


<tr> <th>Danh sách các môn học và số lượng sinh viên:</th></tr>
<table  id="bootstrap-data-table-export" class="table table-striped table-bordered" bordered="1">
  <tr>
    <th>STT</th>
    <th>Mã môn học</th>
    <th>Môn</th>
    <th>Số TC</th>
    <th>Lớp</th>
    <th>Số nhóm</th>
    <th>Hệ số K</th>
    <th>Tổng số SV</th>
  </tr>
  ';
  while($row =mysqli_fetch_array($result_sl))
  {

  $output .='
  <tr>
    <td>'.$a++.'</td>
    <td>'.$row["MonHoc"].'</td>
    <td>'.$row["TenMon"].'</td>
    <td>'.$row["SoTinChi"].'</td>
    <td>'.$row["NhomLop"].'</td>
    <td></td>
    <td>'.$row["HeSoK"].'</td>
    <td>'.$row["SLSV"].'</td>
  </tr>
  ';
  }
 $output .='
 <tr></tr>
<table  id="bootstrap-data-table-export" class="table table-striped table-bordered" bordered="1">
  <tr>
    <th>STT</th>
    <th>Tên vật tư</th>
    <th>Đơn vị tính</th>
    <th>Số lượng</th>
    <th>Đơn giá</th>
    <th>Thành tiền</th>
    <th>Ghi chú</th>
  </tr>
  
  ';
  while($row =mysqli_fetch_array($result))
  {

  $output .='
  <tr>
    <td>'.$i++.'</td>
    <td>'.$row["TenVatTu"].'</td>
    <td>'.$row["DVT"].'</td>
    <td>'.$row["SL"].'</td>
    <td>'.$row["DonGia"].'</td>
    <td>'.$row["ThanhTien"].'</td>
    <td>'.$row["GhiChu"].'</td>
  </tr>
  ';
  }
   while($row =mysqli_fetch_array($result_tt))
  {

  $output .='
  <tr>
  <th></th>
  <th>Tổng tiền</th>
  <th>'.$row["TongTien"].'</th>
  </tr>
  
  ';
  }
$output .='</table>';
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=phieu-yeu-cau-trang-bi.xls");
echo $output;

}
?>
