<?php
include 'connect/myconnect.php';
include 'header.php';
if (isset($_POST['xoa']))
{
	unset($_SESSION['cart']);
}
if(isset($_POST['submit']))
{
	//$m = array_filter($_POST['qty']);
	foreach($_POST['qty'] as $key=>$value)
	{
		if( ($value == 0) and (is_numeric($value)))
		{
			unset ($_SESSION['cart'][$key]);
		}
		else if(($value > 0) and (is_numeric($value)))
		{
			$_SESSION['cart'][$key]=$value;
		}
	}
	header("location:cart.php");
}
?>
<body>
	<?php include 'leftpanel.php' ; ?>
	<hr style="display: inline-grid;">
	<h3 align="center">DANH SÁCH VẬT TƯ ĐỀ NGHỊ</h3>

	<?php
	$ok=1;
	if(isset($_SESSION['cart']))
	{
		foreach($_SESSION['cart'] as $k => $v)
		{
			if(isset($k))
			{
				$ok=2;
			}
		}
	}

	if($ok == 2)
	{

		echo '<div class="container">';
				echo'<div class="table-responsive">';
						echo '<br>';
						echo '<br>';
						echo '<br>';
						echo '<div class="table-responsive">';
								echo '<table class="table table-bordered table-striped">';
										echo '<thead>';
												echo '<th width="30%">Tên vật tư</th>';
												echo '<th width="30%">Đơn vị tính</th>';
												echo '<th width="20%">Số lượng</th>';
												echo '<th width="2%"></th>';
										echo '</thead>';
										echo  '<tbody>';
												echo "<form method='post'>";
														foreach($_SESSION['cart'] as $key=>$value)
														{
															$item[]=$key;
														}
														$str=implode(",",$item);
														$sql="Select * from tblhoachat where id in ($str)";
														$query=mysqli_query($connect,$sql);
														while($row=mysqli_fetch_row($query))
														{
															echo "<tr>";
																	/*echo "<div class='pro'>";*/
																			echo '<td>'."$row[2]".'</td>';
																			echo '<td>'."$row[5]".'</td>';
																			echo '<td> <input type="number" class="form-control" name="qty['."$row[0]".']" size="5" value='."{$_SESSION['cart'][$row[0]]}>".'</td>';
																			echo '<td><a href= "del.php?item='."$row[0]".'"><span style="color:#007bffeb"class="ti-close"></span></a></td>';
																	echo "</tr>";
																}
														echo '</tbody>';
												echo '</table>';
										echo '</div>';
								echo '</div>';
						echo '</div>';
						echo "<div class='pro' align='right'>";
								echo '';
						echo "</div>";
						
								echo "<div style='margin-left:40px'class='col-md-4'>";
								echo "<div class='.col'>";
								echo '<button type="submit" name="submit">Cập nhật số lượng</button><button style="background-color:#ff0000d6" type="submit" name = "xoa">Xóa toàn bộ</button>';
								
								echo '</div>';
							echo "</div>";

				echo '</form>';
				echo '<form method="post">';
				echo '<div style="float:right;padding-left:85px" class="col-md-4">';
				echo '<a href = "chon-hoa-chat.php"><input type="button" class="callback" value="Chọn vật tư" ></a>';
				
				echo '<button type = "submit" name = "saveData">Lưu</button>';
				echo '</div>';
				echo '</form>';
			}
			else
			{
				echo "<div class='pro'>";
						echo "<br/><h5 align='center'>Chưa có vật tư nào được chọn</h5><br />";
						
						echo '<p style="text-align:center"><a href = "chon-hoa-chat.php"><button type="submit" style="background:transparent; border:1.65px solid #343c65; color:black;"name = "btn_select" value = "">Chọn vật tư</button></a></p>';
				
				echo "</div>";
			}
			
		?>
		<?php
		if (isset($_POST["saveData"]))
		{
			foreach($_SESSION['cart'] as $key=>$value)
			{
				$sqlSelect = "SELECT TenHoaChat from tblhoachat WHERE id=".$key;
				$querySelect = mysqli_query($connect,$sqlSelect);
				$name = mysqli_fetch_array($querySelect);
			$id = $_SESSION['MaPhieuXuat'];
			$sl = $_SESSION['cart'][$key];
			$sql1 = "INSERT INTO ctphieuxuatkho
			(MaPhieu,TenVT, SL)
			VALUES
			('$id','$name[0]', '$sl')";
			$query = mysqli_query($connect,$sql1);
			
		echo("<script>location.href = '"."chi-tiet-phieu-xuat-kho.php?id=$id';</script>");
		}
		}
		?>
<!-- 		<form method = "post">
			<button type = "submit" name = "saveData">Lưu</button>
		</form> -->
		<?php include 'scriptindex.php'; ?>
	</body>
</html>