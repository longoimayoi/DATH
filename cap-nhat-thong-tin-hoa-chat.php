<?php include 'header.php'; ?>
<body>
	<?php include 'leftpanel.php' ; ?>
	<div class="container">
		<br />
		<div class="table-responsive">
			<h3 align="center">CẬP NHẬT THÔNG TIN VẬT TƯ</h3><br />
			<div class="card-title">
				<form class="search" method="get" action="">
					<input class="text" type="text" id ="skill_input" name ="btn_search" type="search" placeholder= "Nhập vào tên vật tư cần tìm..." value = "<?php echo isset($_GET["btn_search"]) ? $_GET["btn_search"] : ""; ?>" autocomplete="off">
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
							<th width="1%"></th>
							<th width="12%">Tên vật tư</th>
							<!-- <th width="12%">Công thức</th> -->
							<th width="2%">SLT</th>
							<th width="2%">ĐVT</th>
							<!-- 	<th width="12%">Nguy hiểm chính</th> -->
							<!-- 	<th width="10%">Chú ý</th> -->
							<th width="5%" title="Vị trí đặt">VTĐ</th>
							<!-- <th>Bảo quản</th> -->
							<!-- 	<th width="15%">Điều kiện bảo quản</th>
							<th width="15%">Yêu cầu khi sử dụng</th>-->
							<th width="7%">Ngày mở</th>
							<th width="7%">Ngày hết hạn</th>
							<th title="Hạn sử dụng sau mở" width="7%">HSD sau mở</th>
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
	$(document).ready(function(){
		
		fetch_data();
			});
		$(document).on('click', '.check_box', function(){
			var html = '';
				$(".resize").click(function(){
					$(".resize").css({
						"width"    :"200px",
						"height"   :"100px",
						"transform":"5s",
					});
				});
			if(this.checked)
			{
				html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-TenHoaChat="'+$(this).data('tenhoachat')+'" data-CongThucHoaHoc="'+$(this).data('congthuchoahoc')+'" data-SLT="'+$(this).data('slt')+'" data-DVT="'+$(this).data('dvt')+'" data-NguyHiemChinh="'+$(this).data('nguyhiemchinh')+'" data-ChuY="'+$(this).data('chuy')+'" data-ViTriDat="'+$(this).data('vitridat')+'" data-NoiBaoQuan="'+$(this).data('noibaoquan')+'" data-DieuKienBaoQuan="'+$(this).data('dieukienbaoquan')+'" data-YeuCauKhiSuDung="'+$(this).data('yeucaukhisudung')+'" data-NgayHetHan="'+$(this).data('ngayhethan')+'" data-NgayMoNap="'+$(this).data('ngaymonap')+'" data-SoNgayHetHanSMN="'+$(this).data('songayhethansmn')+'" data-HinhAnh="'+$(this).data('hinhanh')+'"class="check_box" checked /></td>';
				html += '<td><input type="text" name="TenHoaChat[]" class="resize form-control" value="'+$(this).data("tenhoachat")+'" /></td>';
				// html += '<td><input type="text" name="CongThucHoaHoc[]" class="resize form-control" value="'+$(this).data("congthuchoahoc")+'" /></td>';
				html += '<td><input type="text" name="SLT[]" class="resize form-control" value="'+$(this).data("slt")+'" /></td>';
				html += '<td><input type="text" name="DVT[]" class="resize form-control" value="'+$(this).data("dvt")+'" /></td>';
				// html += '<td><input type="text" name="NguyHiemChinh[]" class="resize form-control" value="'+$(this).data("nguyhiemchinh")+'" /></td>';
				// html += '<td><input type="text" name="ChuY[]" class="resize form-control" value="'+$(this).data("chuy")+'" /></td>';
				html += '<td><input type="text" name="ViTriDat[]" class="resize form-control" value="'+$(this).data("vitridat")+'" /></td>';
				// html += '<td><input type="text" name="NoiBaoQuan[]" class="resize form-control" value="'+$(this).data("noibaoquan")+'" /></td>';
				// html += '<td><input type="text" name="DieuKienBaoQuan[]" class="resize form-control" value="'+$(this).data("dieukienbaoquan")+'" /></td>';
				// html += '<td><input type="number" name="YeuCauKhiSuDung[]" class="resize form-control" value="'+$(this).data("yeucaukhisudung")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td>';
				html += '<td><input type="date" name="NgayMoNap[]" class="resize form-control" value="'+$(this).data("ngaymonap")+'" /></td>';
				html += '<td><input type="date" name="NgayHetHan[]" class="resize form-control" value="'+$(this).data("ngayhethan")+'" /></td>';
				html += '<td><input type="text" name="SoNgayHetHanSMN[]" class="resize form-control" value="'+$(this).data("songayhethansmn")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td>';
			}
			else
			{
				html = '<td><input type="checkbox" id="'+$(this).attr('id')+'"data-TenHoaChat="'+$(this).data('tenhoachat')+'"data-CongThucHoaHoc="'+$(this).data('congthuchoahoc')+'"data-SLT="'+$(this).data('slt')+'" data-DVT="'+$(this).data('dvt')+'"data-NguyHiemChinh="'+$(this).data('nguyhiemchinh')+'" data-ChuY="'+$(this).data('chuy')+'" data-ViTriDat="'+$(this).data('vitridat')+'" data-NoiBaoQuan="'+$(this).data('noibaoquan')+'" data-DieuKienBaoQuan="'+$(this).data('dieukienbaoquan')+'" data-YeuCauKhiSuDung="'+$(this).data('yeucaukhisudung')+'" data-NgayHetHan="'+$(this).data('ngayhethan')+'" data-NgayMoNap="'+$(this).data('ngaymonap')+'" data-SoNgayHetHanSMN="'+$(this).data('songayhethansmn')+'" data-HinhAnh="'+$(this).data('hinhanh')+'"class="check_box" /></td>';
				html += '<td>'+$(this).data('tenhoachat')+'</td>';
				// html += '<td>'+$(this).data('congthuchoahoc')+'</td>';
				html += '<td>'+$(this).data('slt')+'</td>';
				html += '<td>'+$(this).data('dvt')+'</td>';
				// html += '<td>'+$(this).data('nguyhiemchinh')+'</td>';
				// html += '<td>'+$(this).data('chuy')+'</td>';
				html += '<td>'+$(this).data('vitridat')+'</td>';
				// html += '<td>'+$(this).data('noibaoquan')+'</td>';
				// html += '<td>'+$(this).data('dieukienbaoquan')+'</td>';
				// html += '<td>'+$(this).data('yeucaukhisudung')+'</td>';
				html += '<td>'+$(this).data('ngaymonap')+'</td>';
				html += '<td>'+$(this).data('ngayhethan')+'</td>';
				html += '<td>'+$(this).data('songayhethansmn')+'</td>';
			}
			$(this).closest('tr').html(html);
			});
		$('#update_form').on('submit', function(event){
			if (confirm("Xác nhận lưu !"))
			{
				event.preventDefault();
				if($('.check_box:checked').length > 0)
				{
					$.ajax({
						url:"multi.php",
						method:"POST",
						data:$(this).serialize(),
						success:function()
						{
							
							fetch_data();
							alert('Cập nhật dữ liệu thành công !');
						}
					})
				}
			}
		});

	function fetch_data()
		{
			$.ajax({
				url:"select.php",
				method:"POST",
				dataType:"json",
				success:function(data)
				{
					var html = '';
					for(var count = 0; count < data.length; count++)
					{
						html += '<tr>';
							html += '<td><input type="checkbox" id="'+data[count].id+'" data-TenHoaChat="'+data[count].TenHoaChat+'" data-CongThucHoaHoc="'+data[count].CongThucHoaHoc+'"data-SLT="'+data[count].SLT+'" data-DVT="'+data[count].DVT+'" data-NguyHiemChinh="'+data[count].NguyHiemChinh+'"data-ChuY="'+data[count].ChuY+'" data-ViTriDat="'+data[count].ViTriDat+'"data-NoiBaoQuan="'+data[count].NoiBaoQuan+'"data-DieuKienBaoQuan="'+data[count].DieuKienBaoQuan+'" data-YeuCauKhiSuDung="'+data[count].YeuCauKhiSuDung+'" data-NgayHetHan="'+data[count].NgayHetHan+'" data-NgayMoNap="'+data[count].NgayMoNap+'" data-SoNgayHetHanSMN="'+data[count].SoNgayHetHanSMN+'" data-HinhAnh="'+data[count].HinhAnh+'"class="check_box"  /></td>';
							html += '<td>'+data[count].TenHoaChat+'</td>';
							// html += '<td>'+data[count].CongThucHoaHoc+'</td>';
							html += '<td>'+data[count].SLT+'</td>';
							html += '<td>'+data[count].DVT+'</td>';
							// html += '<td>'+data[count].NguyHiemChinh+'</td>';
							// html += '<td>'+data[count].ChuY+'</td>';
							html += '<td>'+data[count].ViTriDat+'</td>';
							// html += '<td>'+data[count].NoiBaoQuan+'</td>';
							// html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
							// html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
							html += '<td>'+data[count].NgayMoNap+'</td>';
							html += '<td>'+data[count].NgayHetHan+'</td>';
							html += '<td>'+data[count].SoNgayHetHanSMN+'</td>';
						html += '</tr>';
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
	$(document).ready(function(){
		
fetch_data();
});
$(document).on('click', '.check_box', function(){
var html = '';

$(".resize").click(function(){
$(".resize").css({
"width"    :"200px",
"height"   :"100px",
"transform":"5s",
});
});

if(this.checked)
{
html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-TenHoaChat="'+$(this).data('tenhoachat')+'" data-CongThucHoaHoc="'+$(this).data('congthuchoahoc')+'" data-SLT="'+$(this).data('slt')+'" data-DVT="'+$(this).data('dvt')+'" data-NguyHiemChinh="'+$(this).data('nguyhiemchinh')+'" data-ChuY="'+$(this).data('chuy')+'" data-ViTriDat="'+$(this).data('vitridat')+'" data-NoiBaoQuan="'+$(this).data('noibaoquan')+'" data-DieuKienBaoQuan="'+$(this).data('dieukienbaoquan')+'" data-YeuCauKhiSuDung="'+$(this).data('yeucaukhisudung')+'" data-NgayHetHan="'+$(this).data('ngayhethan')+'" data-NgayMoNap="'+$(this).data('ngaymonap')+'" data-SoNgayHetHanSMN="'+$(this).data('songayhethansmn')+'" data-HinhAnh="'+$(this).data('hinhanh')+'"class="check_box" checked /></td>';
html += '<td><input type="text" name="TenHoaChat[]" class="resize form-control" value="'+$(this).data("tenhoachat")+'" /></td>';
// html += '<td><input type="text" name="CongThucHoaHoc[]" class="resize form-control" value="'+$(this).data("congthuchoahoc")+'" /></td>';
html += '<td><input type="text" name="SLT[]" class="resize form-control" value="'+$(this).data("slt")+'" /></td>';
html += '<td><input type="text" name="DVT[]" class="resize form-control" value="'+$(this).data("dvt")+'" /></td>';
// html += '<td><input type="text" name="NguyHiemChinh[]" class="resize form-control" value="'+$(this).data("nguyhiemchinh")+'" /></td>';
// html += '<td><input type="text" name="ChuY[]" class="resize form-control" value="'+$(this).data("chuy")+'" /></td>';
html += '<td><input type="text" name="ViTriDat[]" class="resize form-control" value="'+$(this).data("vitridat")+'" /></td>';
// html += '<td><input type="text" name="NoiBaoQuan[]" class="resize form-control" value="'+$(this).data("noibaoquan")+'" /></td>';
// html += '<td><input type="text" name="DieuKienBaoQuan[]" class="resize form-control" value="'+$(this).data("dieukienbaoquan")+'" /></td>';
// html += '<td><input type="number" name="YeuCauKhiSuDung[]" class="resize form-control" value="'+$(this).data("yeucaukhisudung")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td>';
html += '<td><input type="date" name="NgayMoNap[]" class="resize form-control" value="'+$(this).data("ngaymonap")+'" /></td>';
html += '<td><input type="date" name="NgayHetHan[]" class="resize form-control" value="'+$(this).data("ngayhethan")+'" /></td>';
html += '<td><input type="text" name="SoNgayHetHanSMN[]" class="resize form-control" value="'+$(this).data("songayhethansmn")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td>';
}
else
{
html = '<td><input type="checkbox" id="'+$(this).attr('id')+'"data-TenHoaChat="'+$(this).data('tenhoachat')+'"data-CongThucHoaHoc="'+$(this).data('congthuchoahoc')+'"data-SLT="'+$(this).data('slt')+'" data-DVT="'+$(this).data('dvt')+'"data-NguyHiemChinh="'+$(this).data('nguyhiemchinh')+'" data-ChuY="'+$(this).data('chuy')+'" data-ViTriDat="'+$(this).data('vitridat')+'" data-NoiBaoQuan="'+$(this).data('noibaoquan')+'" data-DieuKienBaoQuan="'+$(this).data('dieukienbaoquan')+'" data-YeuCauKhiSuDung="'+$(this).data('yeucaukhisudung')+'" data-NgayHetHan="'+$(this).data('ngayhethan')+'" data-NgayMoNap="'+$(this).data('ngaymonap')+'" data-SoNgayHetHanSMN="'+$(this).data('songayhethansmn')+'" data-HinhAnh="'+$(this).data('hinhanh')+'"class="check_box" /></td>';
html += '<td>'+$(this).data('tenhoachat')+'</td>';
// html += '<td>'+$(this).data('congthuchoahoc')+'</td>';
html += '<td>'+$(this).data('slt')+'</td>';
html += '<td>'+$(this).data('dvt')+'</td>';
// html += '<td>'+$(this).data('nguyhiemchinh')+'</td>';
// html += '<td>'+$(this).data('chuy')+'</td>';
html += '<td>'+$(this).data('vitridat')+'</td>';
// html += '<td>'+$(this).data('noibaoquan')+'</td>';
// html += '<td>'+$(this).data('dieukienbaoquan')+'</td>';
// html += '<td>'+$(this).data('yeucaukhisudung')+'</td>';
html += '<td>'+$(this).data('ngaymonap')+'</td>';
html += '<td>'+$(this).data('ngayhethan')+'</td>';
html += '<td>'+$(this).data('songayhethansmn')+'</td>';
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
url:"multi.php",
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
url:'searchselect.php?searchString=<?php echo $_GET['btn_search']; ?>',
method:"POST",
dataType:"json",
success:function(data)
{
var html = '';
for(var count = 0; count < data.length; count++)
{
html += '<tr>';
	html += '<td><input type="checkbox" id="'+data[count].id+'" data-TenHoaChat="'+data[count].TenHoaChat+'" data-CongThucHoaHoc="'+data[count].CongThucHoaHoc+'"data-SLT="'+data[count].SLT+'" data-DVT="'+data[count].DVT+'" data-NguyHiemChinh="'+data[count].NguyHiemChinh+'"data-ChuY="'+data[count].ChuY+'" data-ViTriDat="'+data[count].ViTriDat+'"data-NoiBaoQuan="'+data[count].NoiBaoQuan+'"data-DieuKienBaoQuan="'+data[count].DieuKienBaoQuan+'" data-YeuCauKhiSuDung="'+data[count].YeuCauKhiSuDung+'" data-NgayHetHan="'+data[count].NgayHetHan+'" data-NgayMoNap="'+data[count].NgayMoNap+'" data-SoNgayHetHanSMN="'+data[count].SoNgayHetHanSMN+'" data-HinhAnh="'+data[count].HinhAnh+'"class="check_box"  /></td>';
	html += '<td>'+data[count].TenHoaChat+'</td>';
	// html += '<td>'+data[count].CongThucHoaHoc+'</td>';
	html += '<td>'+data[count].SLT+'</td>';
	html += '<td>'+data[count].DVT+'</td>';
	// html += '<td>'+data[count].NguyHiemChinh+'</td>';
	// html += '<td>'+data[count].ChuY+'</td>';
	html += '<td>'+data[count].ViTriDat+'</td>';
	// html += '<td>'+data[count].NoiBaoQuan+'</td>';
	// html += '<td>'+data[count].DieuKienBaoQuan+'</td>';
	// html += '<td>'+data[count].YeuCauKhiSuDung+'</td>';
	html += '<td>'+data[count].NgayMoNap+'</td>';
	html += '<td>'+data[count].NgayHetHan+'</td>';
	html += '<td>'+data[count].SoNgayHetHanSMN+'</td>';

	
html += '</tr>';
}
$('tbody').html(html);
}
});
}
</script>
<style>
	
</style>
<?php }
?>
</script>
<script>
	$(function() {
		$("#skill_input").autocomplete({
			source: "chemistry_name.php",
		});
	});
</script>
<?php include 'scriptindex.php'; ?>
</body>
</html>