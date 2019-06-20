<?php include 'header.php'; ?>
<?php include 'connect/myconnect.php'; ?>
<body>
	<?php include 'leftpanel.php' ; ?>
	<div class="container">
		<br />
		<div class="table-responsive">
			<h3 align="center">Cập nhật thông tin dụng cụ - vật tư</h3><br />
			<div class="card-title">
				<form class="search" method="get" action="">
					<input class="text" type="text" id ="skill_input" name ="btn_search" type="search" placeholder= "Nhập vào tên dụng cụ cần tìm..." value = "<?php echo isset($_GET["btn_search"]) ? $_GET["btn_search"] : ""; ?>" autocomplete="off">
					<i class="fa fa-search"></i>
				</form>
			</div>
			<form method="post" id="update_form">
				<div align="left">
					<button type="submit" name="multiple_update" id="multiple_update">Lưu dữ liệu</button>
				</div>
				<br />
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<th width="3%"></th>
							<th width="20%">Tên Dụng Cụ</th>
							<th width="15%">Chất liệu</th>
							<th width="35%">Quy cách</th>
							<th width="15%">Đơn vị tính</th>
							<th width="30%">Số lượng tồn</th>
						</thead>
					<tbody></tbody>
				</table>
			</div>
		</form>
	</div>
</div>
<?php
if (!isset($_GET["btn_search"]))
	{
?>
<script >
	$(document).ready(function() {
				fetch_data();
			});
		
			fetch_data();
			$(document).on('click', '.check_box', function(){
				var html = '';
				if(this.checked)
				{
					html = '<td><input type="checkbox" MaDungCu="'+$(this).attr('madungcu')+'" data-TenDungCu="'+$(this).data('tendungcu')+'" data-ChatLieu="'+$(this).data('chatlieu')+'" data-QuyCach="'+$(this).data('quycach')+'" data-DVT="'+$(this).data('dvt')+'" data-SLT="'+$(this).data('slt')+'" class="check_box" checked /></td>';
					html += '<td><input type="text" name="TenDungCu[]" class="form-control" value="'+$(this).data("tendungcu")+'" /></td>';
					html += '<td><input type="text" name="ChatLieu[]" class="form-control" value="'+$(this).data("chatlieu")+'" /></td>';
					html += '<td><input type="text" name="QuyCach[]" class="form-control" value="'+$(this).data("quycach")+'" /></td>';
					html += '<td><input type="text" name="DVT[]" class="form-control" value="'+$(this).data("dvt")+'" /></td>';
					html += '<td><input type="number" name="SLT[]" class="form-control" value="'+$(this).data("slt")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('madungcu')+'" /></td>';
				}
				else
				{
					html = '<td><input type="checkbox" MaDungCu="'+$(this).attr('madungcu')+'" data-TenDungCu="'+$(this).data('tendungcu')+'" data-ChatLieu="'+$(this).data('chatlieu')+'" data-QuyCach="'+$(this).data('quycach')+'" data-DVT="'+$(this).data('dvt')+'" data-SLT="'+$(this).data('slt')+'" class="check_box" /></td>';
					html += '<td>'+$(this).data('tendungcu')+'</td>';
					html += '<td>'+$(this).data('chatlieu')+'</td>';
					html += '<td>'+$(this).data('quycach')+'</td>';
					html += '<td>'+$(this).data('dvt')+'</td>';
					html += '<td>'+$(this).data('slt')+'</td>';
				}
				$(this).closest('tr').html(html);
				})	;
			$('#update_form').on('submit', function(event){
				
				if (confirm("Xác nhận lưu dữ liệu !"))
				{
					event.preventDefault();
					if($('.check_box:checked').length > 0)
					{
						$.ajax({
							url:"multiupins.php",
							method:"POST",
							data:$(this).serialize(),
							success:function()
							{
								alert('Cập nhật dữ liệu thành công !');
								fetch_data();
							}
						})
					}
				}
			});
	
		function fetch_data()
		{
			$.ajax({
				url:"select_instruments.php",
				method:"POST",
				dataType:"json",
				success:function(data)
				{
					var html = '';
					for(var count = 0; count < data.length; count++)
					{
						html += '<tr>';
							html += '<td><input type="checkbox" MaDungCu="'+data[count].MaDungCu+'" data-TenDungCu="'+data[count].TenDungCu+'" data-ChatLieu="'+data[count].ChatLieu+'" data-QuyCach="'+data[count].QuyCach+'" data-DVT="'+data[count].DVT+'"data-SLT="'+data[count].SLT+'" class="check_box"  /></td>';
							html += '<td>'+data[count].TenDungCu+'</td>';
							html += '<td>'+data[count].ChatLieu+'</td>';
							html += '<td>'+data[count].QuyCach+'</td>';
							html += '<td>'+data[count].DVT+'</td>';
							html += '<td>'+data[count].SLT+'</td></tr>';
						}
						$('tbody').html(html);
					}
				});
			}
	</script>
	<?php
	}
	else
	{
	?>
	<script >
		$(document).ready(function() {
				fetch_data();
			});

			$(document).on('click', '.check_box', function(){
				var html = '';
				if(this.checked)
				{
					html = '<td><input type="checkbox" MaDungCu="'+$(this).attr('madungcu')+'" data-TenDungCu="'+$(this).data('tendungcu')+'" data-ChatLieu="'+$(this).data('chatlieu')+'" data-QuyCach="'+$(this).data('quycach')+'" data-DVT="'+$(this).data('dvt')+'" data-SLT="'+$(this).data('slt')+'" class="check_box" checked /></td>';
					html += '<td><input type="text" name="TenDungCu[]" class="form-control" value="'+$(this).data("tendungcu")+'" /></td>';
					html += '<td><input type="text" name="ChatLieu[]" class="form-control" value="'+$(this).data("chatlieu")+'" /></td>';
					html += '<td><input type="text" name="QuyCach[]" class="form-control" value="'+$(this).data("quycach")+'" /></td>';
					html += '<td><input type="text" name="DVT[]" class="form-control" value="'+$(this).data("dvt")+'" /></td>';
					html += '<td><input type="number" name="SLT[]" class="form-control" value="'+$(this).data("slt")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('madungcu')+'" /></td>';
				}
				else
				{
					html = '<td><input type="checkbox" MaDungCu="'+$(this).attr('madungcu')+'" data-TenDungCu="'+$(this).data('tendungcu')+'" data-ChatLieu="'+$(this).data('chatlieu')+'" data-QuyCach="'+$(this).data('quycach')+'" data-DVT="'+$(this).data('dvt')+'" data-SLT="'+$(this).data('slt')+'" class="check_box" /></td>';
					html += '<td>'+$(this).data('tendungcu')+'</td>';
					html += '<td>'+$(this).data('chatlieu')+'</td>';
					html += '<td>'+$(this).data('quycach')+'</td>';
					html += '<td>'+$(this).data('dvt')+'</td>';
					html += '<td>'+$(this).data('slt')+'</td>';
				}
				$(this).closest('tr').html(html);
			})	;
			$('#update_form').on('submit', function(event){

				if (confirm("Xác nhận lưu !"))
				{
					event.preventDefault();
					if($('.check_box:checked').length > 0)
					{
						$.ajax({
							url:"multiupins.php",
							method:"POST",
							data:$(this).serialize(),
							success:function()
							{
								alert('Cập nhật dữ liệu thành công !');
								fetch_data();
							}
						})
					}
				}
			});

			function fetch_data()
			{
				$.ajax({
					url:'searchselectinstruments.php?searchString=<?php echo $_GET['btn_search']; ?>',
					method:"POST",
					dataType:"json",
					success:function(data)
					{
						var html = '';
						for(var count = 0; count < data.length; count++)
						{
							html += '<tr>';
							html += '<td><input type="checkbox" MaDungCu="'+data[count].MaDungCu+'" data-TenDungCu="'+data[count].TenDungCu+'" data-ChatLieu="'+data[count].ChatLieu+'" data-QuyCach="'+data[count].QuyCach+'" data-DVT="'+data[count].DVT+'"data-SLT="'+data[count].SLT+'" class="check_box"  /></td>';
							html += '<td>'+data[count].TenDungCu+'</td>';
							html += '<td>'+data[count].ChatLieu+'</td>';
							html += '<td>'+data[count].QuyCach+'</td>';
							html += '<td>'+data[count].DVT+'</td>';
							html += '<td>'+data[count].SLT+'</td></tr>';
						}
						$('tbody').html(html);
					}
				});
			}
		</script>
		<?php }
		?>
		<script>
			$(function() {
				$("#skill_input").autocomplete({
					source: "instrument_name.php",
				});
			});
		</script>
		<?php include 'scriptindex.php'; ?>
	</body>
</html>