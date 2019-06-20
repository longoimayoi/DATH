<?php
include 'header.php';
$conn = mysqli_connect("localhost","root","root","dath");
$output= '';
// $mysqli_set_charset($conn,'utf8');
$conn -> set_charset("utf8");
$id = $_GET["id"];
$sql = "SELECT * FROM ctphieuxuatkho WHERE MaPhieu=$id ORDER BY  STT";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
$output .='
<table  id="bootstrap-data-table-export" class="table table-striped table-bordered" bordered="10">
  <tr>
    <th>STT</th>
    <th>Mã phiếu</th>
    <th>Tên vật tư</th>
    <th>Số lượng</th>
  </tr>
  ';
  while($row =mysqli_fetch_array($result))
  {
  $output .='
  <tr>
    <td>'.$row["STT"].'</td>
    <td>'.$row["MaPhieu"].'</td>
    <td>'.$row["TenVT"].'</td>
    <td>'.$row["SL"].'</td>
  </tr>
  ';
  }
$output .='</table>';
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=phieu-xuat-kho.xls");
echo $output;

}
?>
