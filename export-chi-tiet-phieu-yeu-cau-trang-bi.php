<?php
include 'header.php';
$conn = mysqli_connect("localhost","root","","dath");
$output= '';
// $mysqli_set_charset($conn,'utf8');
$conn -> set_charset("utf8");
$id = $_GET["id"];
$sql = "SELECT * FROM tblphieuyeucautrangbi WHERE MaHD=$id ORDER BY  STT";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
$output .='
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
    <td>'.$row["STT"].'</td>
    <td>'.$row["TenVatTu"].'</td>
    <td>'.$row["DVT"].'</td>
    <td>'.$row["SL"].'</td>
    <td>'.$row["DonGia"].'</td>
    <td>'.$row["ThanhTien"].'</td>
    <td>'.$row["GhiChu"].'</td>
  </tr>
  ';
  }
$output .='</table>';
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=phieu-yeu-cau-trang-bi.xls");
echo $output;

}
?>
