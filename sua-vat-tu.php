<?php 
include('connect/myconnect.php');
if(isset($_POST['luu']))
{
	$id=$_GET['id'];
  $TenVatTu=$_POST['TenVatTu'];
  $SLT=$_POST['SLT'];
  $DVT=$_POST['DVT'];
  $VTD=$_POST['VTD'];
  $NgayMoNap=$_POST['NgayMoNap'];
  $NgayHetHan=$_POST['NgayHetHan'];
  $SoNgayHetHanSMN=$_POST['SoNgayHetHanSMN'];
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $day=date("Y-m-d-H-i-s");
  $query_a="SELECT HinhAnh FROM tblhoachat WHERE id=".$id."";
  $result_a=mysqli_query($connect,$query_a);
  $anh=mysqli_fetch_assoc($result_a);
  //$hinh=var_dump($anh['HinhAnh']);
  if (file_exists($_FILES['hinh']['tmp_name']) || is_uploaded_file($_FILES['hinh']['tmp_name']))
  {
  	 $file_name=$_FILES['hinh']['name'];
  	$file_tmp=$_FILES['hinh']['tmp_name']; 	
	move_uploaded_file($file_tmp, "./HinhHoaChat/".$file_name);
	unlink('./HinhHoaChat/'.$anh['HinhAnh']);
	$hinh=$file_name;
	$query="UPDATE tblhoachat SET TenHoaChat='$TenVatTu',HinhAnh='$hinh',SLT='$SLT',DVT='$DVT',ViTriDat='$VTD',NgayMoNap='$NgayMoNap',NgayHetHan='$NgayHetHan',SoNgayHetHanSMN='$SoNgayHetHanSMN' WHERE id=".$id."";
  }
  else
  {
  	$query="UPDATE tblhoachat SET TenHoaChat='$TenVatTu',SLT='$SLT',DVT='$DVT',ViTriDat='$VTD',NgayMoNap='$NgayMoNap',NgayHetHan='$NgayHetHan',SoNgayHetHanSMN='$SoNgayHetHanSMN' WHERE id=".$id."";
  }

  
  $result=mysqli_query($connect,$query);
  if(mysqli_affected_rows($connect)==1)
  {
    echo "<script>alert('Sửa thành công')</script>";
        

  }
   echo("<script>location.href = '"."danh-sach-hoa-chat.php';</script>");
}


 ?>