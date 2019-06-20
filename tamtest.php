<?php include 'header.php'; ?>
<?php include 'connect/myconnect.php';
/*session_start();*/
?>
<body>
	<?php include 'leftpanel.php' ; ?>
	<div class="container">
		<br />
		<div class="table-responsive">
			<h3 align="center">Báo Giá</h3><br />
			<div class="card-title">
			</div>
			<!-- <form method="post"> -->
				<!-- <br /> -->
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<th width="20%">Tên Vật tư</th>
							<th width="10%">Đơn vị tính</th>
							<th width="10%">Số lượng</th>
							<th width="20%">Đơn giá</th>
							<!-- <th width="20%">Thành tiền</th> -->
							<th width="20%">Ghi Chú</th>
						</thead>
						<tbody>
							<?php
							$nlap = $_GET['ngaylap'];
							$sql = "SELECT * FROM tblphieuyeucautrangbi WHERE  NgayLapPhieu='$nlap'  ";
							$query = mysqli_query($connect, $sql);
							$arr = array();
							while ($row = mysqli_fetch_assoc($query))
							{
								array_push($arr, $row['TenVatTu']);
								echo "<tr>";
								echo '<td>'."<p>".$row['TenVatTu']."" . "</p>".'</td>';
								echo '<td>'."<p>".$row['DVT']."" . "</p>".'</td>';
								echo '<td>'."<p>".$row['SL']."" . "</p>".'</td>';
								echo '<td>'."<p>".$row['DonGia']."" . "</p>".'</td>';
								echo '<td>'."<p>".$row['GhiChu']."" . "</p>".'</td>';
								
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			<!-- </form> -->
		</div>

	</br>
</br>
<div class="table-responsive">
	<h3 align="center">Vật tư còn tồn trong kho</h3><br />
	<div class="card-title">
	</div>
<!-- 	<form method="post"> -->
		<!-- <br /> -->
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<th width="20%">Tên Vật tư</th>
					<th width="10%">Đơn vị tính</th>
					<th width="10%">Số lượng</th>
					<!-- <th width="20%">Đơn giá</th>
					<th width="20%">Thành tiền</th>
					<th width="20%">Ghi Chú</th> -->
				</thead>
				<tbody>

					<?php
					foreach($arr as $tvt)
					{
						$sqltk = "SELECT TenHoaChat, DVT, SLT FROM `tblhoachat` WHERE TenHoaChat in (SELECT TenVatTu from tblphieuyeucautrangbi where NgayLapPhieu='$nlap'  and TenVatTu = '$tvt' )  ";
						$querytk = mysqli_query($connect, $sqltk);
						while ($rowtk = mysqli_fetch_assoc($querytk))
						{
							echo "<tr>";
							echo '<td>'."<p>".$rowtk['TenHoaChat']."" . "</p>".'</td>';
							echo '<td>'."<p>".$rowtk['DVT']."" . "</p>".'</td>';
							echo '<td>'."<p>".$rowtk['SLT']."" . "</p>".'</td>';
							echo "</tr>";
						}

					}

					?>



					
				</tbody>
			</table>
		</div>
	<!-- </form> -->
</div>
	</br>
</br>
 <div style="text-align: center" >
                  <button type="submit" name="btn_Save">XỬ LÝ</button>
                </div>

	</br>
</br>
</div>
<?php include 'scriptindex.php'; ?>
</body>
</html>