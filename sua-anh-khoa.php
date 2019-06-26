<?php 
include('connect/myconnect.php');
if(isset($_POST['luu']))
{
	$id=$_GET['id'];

  $query_a="SELECT Hinh FROM tblkhoa";
  $result_a=mysqli_query($connect,$query_a);
  $anh=mysqli_fetch_assoc($result_a);
  //$hinh=var_dump($anh['HinhAnh']);
  if (file_exists($_FILES['hinh']['tmp_name']) || is_uploaded_file($_FILES['hinh']['tmp_name']))
  {
  	 $file_name=$_FILES['hinh']['name'];
  	$file_tmp=$_FILES['hinh']['tmp_name']; 	
	move_uploaded_file($file_tmp, "./images/".$file_name);
	// unlink("./images/".$anh['Hinh']);
	$hinh=$file_name;
	$query="UPDATE tblkhoa SET Hinh='$hinh' WHERE MaKhoa=".$id."";
  unlink('./images/'.$anh['HinhAnh']);
  }
 
  $result=mysqli_query($connect,$query);
  if(mysqli_affected_rows($connect)==1)
  {
    echo "<script>alert('Sửa thành công')</script>";
        

  }
   echo("<script>location.href = '"."khoa.php';</script>");
}


 ?>