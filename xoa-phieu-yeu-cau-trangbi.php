<?php 
include('connect/myconnect.php');
$MaHD=$_GET['MaHD'];
			
        	$query="DELETE FROM tblphieuyeucautrangbi WHERE MaHD=".$MaHD."";
	        $result=mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
	     	$query_tn="DELETE FROM tblhoadon WHERE MaHD=".$MaHD."";
        	$result_tn=mysqli_query($connect,$query_tn)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
        	if(mysqli_affected_rows($connect)==1)
	     	{
		         echo  "<script type='text/javascript'>alert('Đã Xóa phiếu đề xuất');</script>";
		          echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");
	        
		     }
		     else
		      	echo 'sai';
		     

        
 ?>