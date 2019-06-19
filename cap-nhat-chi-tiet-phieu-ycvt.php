<?php include 'header.php';
	ob_start();
include('connect/myconnect.php');
include 'leftpanel.php' ;
if(isset($_POST['Back']))
{
	$query_c="SELECT COUNT(DonGia) as SL FROM  tblphieuyeucautrangbi WHERE MaHD=".$_GET['MaHD']." AND DonGia < 1";
	$result_c=mysqli_query($connect,$query_c);
	list($SL)=mysqli_fetch_array($result_c,MYSQLI_NUM);
	if($SL <=0)
	{
	   // $query_up="UPDATE tblhoadon SET TrangThai=1 WHERE MaHD=".$_GET['MaHD']." ";
	    $query_up="UPDATE tblhoadon SET TrangThai=1, TongTien = (SELECT SUM(ThanhTien) as ThanhTien from tblphieuyeucautrangbi WHERE MaHD='{$_GET['MaHD']}') WHERE MaHD=".$_GET['MaHD'];
	    $result_up=mysqli_query($connect,$query_up);
	    if(mysqli_affected_rows($connect)==1)
      	{
      		echo "<script>alert('Báo giá thành công')</script>";
        echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");
         
        
	     }
	      else
	      {
	        echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=".$_GET['MaHD']."';</script>");
	      }
	}
	else
	      {
	      	echo "<script>confirm('Bạn vẫn chưa báo giá hết')</script>";
	      	echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=".$_GET['MaHD']."';</script>");
	        
	      }
}
?>
<body>  
	<div class="container">  
		<br />
		<div class="table-responsive">  
			<h3 align="center">Báo giá phiếu đề xuất</h3><br />
			
		<form action="" method="post">
			<button  type="submit" name="Back">Hoàn thành</button>
		</form>
		<br>
		<form method="post" id="update_form">

				<div align="left">
					<button style="margin-right: 662px;" type="submit" name="multiple_update" id="multiple_update">Lưu dữ liệu</button>
					<!-- <input type="submit" name="multiple_update" id="multiple_update" class="btn btn-info" value="Lưu dữ liệu" /> -->
					<!-- <a class="btn btn-danger" href="danhsach-phieu-yeu-cau-trangbi.php">Trở lại</a> -->
						
					<button style="float: right;" type="reset" onclick="window.location.href='chitiet-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $_GET['MaHD']?>'">Trở lại</button>

			

			</div>
				<br />
		        <div class="table-responsive">
		          <table class="table table-bordered table-striped">
		            <thead>
		              <th width="3%"></th>
		              <th width="20%">Tên Vật tư</th>
		              <th width="10%">Đơn vị tính</th>
		              <th width="10%">Số lượng</th>
		              <th width="20%">Đơn giá</th>
		              <!-- <th width="20%">Thành tiền</th> -->
		              <th width="20%">Ghi chú</th>
		            </thead> 
		            <tbody>
		            </tbody>
		          </table>
		        </div>
		        
		      </form>
			</div>
	</div>
	<?php include 'scriptindex.php'; ?>
</body>  

</html>
<?php ob_flush(); ?>
<script >
	
	$(document).on('click', '.check_box', function(){

					var html = '';

					if(this.checked)
					{
						html = '<td><input type="checkbox" STT="'+$(this).attr('stt')+'" data-TenVatTu="'+$(this).data('tenvattu')+'" data-DVT="'+$(this).data('dvt')+'" data-SL="'+$(this).data('sl')+'" data-DonGia="'+$(this).data('dongia')+'" data-ThanhTien="'+$(this).data('thanhtien')+'" data-GhiChu="'+$(this).data('ghichu')+'" class="check_box" checked /></td>';
						html += '<td><input disabled type="text" name="TenVatTu[]" class="form-control" value="'+$(this).data("tenvattu")+'" /></td>';
						html += '<td><input disabled type="text" name="DVT[]" class="form-control" value="'+$(this).data("dvt")+'" /></td>';
						html += '<td><input type="text" name="SL[]" class="form-control" value="'+$(this).data("sl")+'" /></td>';
						html += '<td><input type="text" name="DonGia[]" class="form-control" value="'+$(this).data("dongia")+'" /></td>';
						/*html += '<td><input disabled="" type="text" name="ThanhTien[]" class="form-control" value="'+$(this).data("thanhtien")+'" /></td>';*/
						html += '<td><input disabled type="text" name="GhiChu[]" class="form-control" value="'+$(this).data("ghichu")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('stt')+'" /></td>'
						
					}
					else
					{
						html = '<td><input type="checkbox" STT="'+$(this).attr('stt')+'" data-TenVatTu="'+$(this).data('tenvattu')+'" data-DVT="'+$(this).data('dvt')+'" data-SL="'+$(this).data('sl')+'" data-DonGia="'+$(this).data('dongia')+'" data-ThanhTien="'+$(this).data('thanhtien')+'" data-GhiChu="'+$(this).data('ghichu')+'" class="check_box" /></td>';
						html += '<td>'+$(this).data('tenvattu')+'</td>';
						html += '<td>'+$(this).data('dvt')+'</td>';
						html += '<td>'+$(this).data('sl')+'</td>';
						html += '<td>'+$(this).data('dongia')+'</td>';
						/*html += '<td>'+$(this).data('thanhtien')+'</td>';*/
						html += '<td>'+$(this).data('ghichu')+'</td>';

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
								url:"save-chitiet-yeu-cau.php",
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

		
			$(document).ready(function() {
				fetch_data();
			});

				function fetch_data()
				{

					$.ajax({
						url:"yeucautrangbi.php?MaHD=<?php echo $_GET['MaHD'] ?>",
						method:"GET",
						dataType:"json",
						success:function(data)
						{
							var html = '';
							for(var count = 0; count < data.length; count++)
							{
								html += '<tr>';
								html += '<td><input type="checkbox" STT="'+data[count].STT+'"data-TenVatTu="'+data[count].TenVatTu+'" data-DVT="'+data[count].DVT+'" data-SL="'+data[count].SL+'" data-DonGia="'+data[count].DonGia+'" data-ThanhTien="'+data[count].ThanhTien+'"data-GhiChu="'+data[count].GhiChu+'" class="check_box"  /></td>';
								html += '<td>'+data[count].TenVatTu+'</td>';
								html += '<td>'+data[count].DVT+'</td>';
								html += '<td>'+data[count].SL+'</td>';
								html += '<td>'+data[count].DonGia+'</td>';
							/*	html += '<td>'+data[count].ThanhTien+'</td>';*/
								html += '<td>'+data[count].GhiChu+'</td></tr>';

							}
							$('tbody').html(html);
						}
					});
				}
		</script>
