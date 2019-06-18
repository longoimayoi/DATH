<?php 
	include('connect/myconnect.php');
	$MaHD=$_GET['MaHD'];
   date_default_timezone_set('Asia/Ho_Chi_Minh');
    $today=date("Y-m-d H:i:s");
	$LyDoHuy=$_POST['LyDoHuy']; 
   $query_sum="SELECT sum(ThanhTien) FROM tblphieuyeucautrangbi WHERE MaHD=".$MaHD."";
      $result_sum=mysqli_query($connect,$query_sum);
      list($ThanhTien)=mysqli_fetch_array($result_sum,MYSQLI_NUM);
	$query="UPDATE tblhoadon set LyDoHuy='$LyDoHuy',TrangThai=4 ,NgayHuyPhieu='$today',TongTien='$ThanhTien' WHERE MaHD=".$MaHD."";
	$result=mysqli_query($connect,$query);
	if(mysqli_affected_rows($connect)==1)
      {
        echo "<script>alert('Hủy phiếu yêu cầu trang bị thành công')</script>";
          echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");
      }
      else
      {
        echo "<script>alert('Hủy phiếu yêu cầu trang bị không thành công')</script>";
      }

 ?>