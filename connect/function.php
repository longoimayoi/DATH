<?php

	function hienthidanhmuc($parent_id='0',$start_text='')
	{
		global $connect;
		$query_dm="SELECT * FROM tbldanhmuc  WHERE  parent_id='".$parent_id."'   ORDER BY parent_id ASC";
		$result_dm=mysqli_query($connect,$query_dm);
		while ($category=mysqli_fetch_array($result_dm,MYSQLI_ASSOC)) {
			

			echo ("<option value='".$category["MaDanhMuc"]."'>".$start_text.$category["TenDanhMuc"]."</option>");
			hienthidanhmuc($category["MaDanhMuc"],$start_text."-");
		}
		return true;
	}
	function hienthi($name,$class)
	{
		global $connect;
		echo "<select id='catalog-pattern' name='".$name."' class ='".$class."' required> ";
		echo "<option value='' >--Chọn danh mục--</option>";
		hienthidanhmuc();
		echo "</select>";
	}
	
?>