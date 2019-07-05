
<?php
include 'header.php';
include('connect/myconnect.php');
include('./template/autoload.php');
include('./alhimik1986/php-excel-templator/src/PhpExcelTemplator.php');
include('./alhimik1986/php-excel-templator/src/params/CallbackParam.php');
include('./alhimik1986/php-excel-templator/src/params/ExcelParam.php');


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
$query_k = "SELECT TenKhoa,GhiChu FROM tblhoadon as hd JOIN tblkhoa as k WHERE k.MaKhoa=hd.MaKhoa AND hd.MaHD=$MaHD";
$result_k = mysqli_query($connect,$query_k);
list($TenKhoa,$GhiChu)=mysqli_fetch_array($result_k,MYSQLI_NUM);

while($row =mysqli_fetch_array($result,MYSQLI_ASSOC))
        {

            $item[]=$row['TenVatTu'];
            $item2[]=$row['DVT'];
            $item3[]=$row['SL'];
            $item4[]=$row['DonGia'];
            $item5[]=$row['ThanhTien'];
            $item6[]=$row['GhiChu'];
            


        }
        /*$strid=implode(',', $item);
        $strname=implode(',', $item2);
        echo $strid;
        echo "<br>";
        echo $strname;*/
        $params = [
            '[TenVatTu]' => $item,
            '[DVT]' => $item2,
            '[SL]' => $item3,
            '[DonGia]' => $item4,
            '[ThanhTien]' => $item5,
            '[GhiChu]' => $item6,
           

        ];
        PhpExcelTemplator::saveToFile('./template/template.xlsx', './template/exported_file.xlsx', $params);

// if(mysqli_num_rows($result)>0)
// {
// $output .='

// <table  id="bootstrap-data-table-export" class="table table-striped table-bordered" bordered="1">
// <tr><td>I. Đề xuất:</td></tr>
// <tr><td>Đơn vị yêu cầu: '.$TenKhoa.'</td></tr>
// <tr><td>Lý do: '.$GhiChu.'</td></tr>
// <tr></tr>



// <table  id="bootstrap-data-table-export" class="table table-striped table-bordered" bordered="1">
//   <tr>
//     <th>STT</th>
//     <th>Mã môn học</th>
//     <th>Môn</th>
//     <th>Số TC</th>
//     <th>Lớp</th>
//     <th>Số nhóm</th>
//     <th>Hệ số K</th>
//     <th>Tổng số SV</th>
//   </tr>
//   ';
//   while($row =mysqli_fetch_array($result_sl))
//   {

//   $output .='
//   <tr>
//     <td>'.$a++.'</td>
//     <td>'.$row["MonHoc"].'</td>
//     <td>'.$row["TenMon"].'</td>
//     <td>'.$row["SoTinChi"].'</td>
//     <td>'.$row["NhomLop"].'</td>
//     <td></td>
//     <td>'.$row["HeSoK"].'</td>
//     <td>'.$row["SLSV"].'</td>
//   </tr>
//   ';
//   }
//  $output .='
//  <tr></tr>
// <table  id="bootstrap-data-table-export" class="table table-striped table-bordered" bordered="1">
//   <tr>
//     <th>STT</th>
//     <th>Tên vật tư</th>
//     <th>Đơn vị tính</th>
//     <th>Số lượng</th>
//     <th>Đơn giá</th>
//     <th>Thành tiền</th>
//     <th>Ghi chú</th>
//   </tr>
  
//   ';
//   while($row =mysqli_fetch_array($result))
//   {

//   $output .='
//   <tr>
//     <td>'.$i++.'</td>
//     <td>'.$row["TenVatTu"].'</td>
//     <td>'.$row["DVT"].'</td>
//     <td>'.$row["SL"].'</td>
//     <td>'.$row["DonGia"].'</td>
//     <td>'.$row["ThanhTien"].'</td>
//     <td>'.$row["GhiChu"].'</td>
//   </tr>
//   ';
//   }
//    while($row =mysqli_fetch_array($result_tt))
//   {

//   $output .='
//   <tr>
//   <th></th>
//   <th>Tổng tiền</th>
//   <th>'.$row["TongTien"].'</th>
//   </tr>
  
//   ';
//   }
// $output .='</table>';
// header("Content-Type: application/xls");
// header("Content-Disposition: attachment; filename=phieu-yeu-cau-trang-bi.xls");
// echo $output;

// }
?>
