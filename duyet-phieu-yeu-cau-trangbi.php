<?php 
 include('connect/myconnect.php');
 $MaHD=$_GET['MaHD'];
date_default_timezone_set('Asia/Ho_Chi_Minh');
      $today=date("Y-m-d H:i:s");
      $query_sum="SELECT sum(ThanhTien) FROM tblphieuyeucautrangbi WHERE MaHD=".$MaHD."";
      $result_sum=mysqli_query($connect,$query_sum);
      list($ThanhTien)=mysqli_fetch_array($result_sum,MYSQLI_NUM);
      $query_ud="UPDATE tblhoadon SET TrangThai=2,NgayDuyetPhieu='$today',TongTien='$ThanhTien' WHERE MaHD='$MaHD' ";
      $result_ud=mysqli_query($connect,$query_ud);
       if(mysqli_affected_rows($connect)==1)
      {
         echo  "<script type='text/javascript'>alert('Duyệt phiếu đề xuất thành công');</script>";
          echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");
        
      }
      else
      {
        echo "<script>alert('Duyệt phiếu không thành công')</script>";
      }
       
     
 ?>