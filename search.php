<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');?>
<body>
	<?php include 'leftpanel.php' ; ?>
	<div class="content mt-3">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<strong class="card-title">Tìm kiếm hóa chất trong kho</strong>
						</div>
						<br>
						<div class="card-title">
							<form class="search" method="post" action="">
								<input class="text" type="text" id ="skill_input" name ="btn_search" type="search" placeholder= "Nhập vào tên hóa chất cần tìm..." value = "<?php echo isset($_POST["btn_search"]) ? $_GET["btn_search"] : ""; ?>" autocomplete="off">
								<i class="fa fa-search"></i>
							</form>
							
						</div>
						<div class="card-body">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Mã hóa chất</th>
										<th scope="col">Tên hóa chất</th>
										<th scope="col">Đơn vị tính</th>
										<th scope="col">Số lượng tồn</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!isset($_POST["btn_search"]))
									{
									$sql = "Select * from tblhoachat";
									$query = mysqli_query($connect, $sql);
									while ($row = mysqli_fetch_row($query))
									{
									
									echo "<tr>";
										echo '<td>'."<p>$row[0]" . "</p>".'</td>';
											echo '<td>'."<p>$row[2]" . "</p>".'</td>';
											echo '<td>'."<p>$row[4]" . "</p>".'</td>';
											echo '<td>'."<p>$row[3]" . "</p>".'</td>';
									echo "</tr>";
									}
									}
									else
									{
									$search = $_POST["btn_search"];
									if ($search == "")
									{
									$sql = "Select * from tblhoachat";
									$query = mysqli_query($connect, $sql);
									while ($row = mysqli_fetch_row($query))
									{
									echo "<tr>";
										echo '<td>'."<p>$row[0]" . "</p>".'</td>';
											echo '<td>'."<p>$row[2]" . "</p>".'</td>';
											echo '<td>'."<p>$row[4]" . "</p>".'</td>';
											echo '<td>'."<p>$row[3]" . "</p>".'</td>';
									echo "</tr>";
									}
									}
									else
									{
									$sql_search = "Select * from tblhoachat where TenHoaChat like '%$search%'";
									$query = mysqli_query($connect, $sql_search);
									if (mysqli_num_rows($query) > 0)
									while ($row = mysqli_fetch_row($query))
									{
										echo "<tr>";
										echo '<td>'."<p>$row[0]" . "</p>".'</td>';
											echo '<td>'."<p>$row[2]" . "</p>".'</td>';
											echo '<td>'."<p>$row[4]" . "</p>".'</td>';
											echo '<td>'."<p>$row[3]" . "</p>".'</td>';
									echo "</tr>";
									}
									else
									{
										echo "Không tìm thấy hóa chất vừa nhập";
									}
									}
									}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'scriptindex.php'; ?>
</body>
</html>
<script>
$(function() {
$("#skill_input").autocomplete({
source: "categoryname.php",
});
});
</script>