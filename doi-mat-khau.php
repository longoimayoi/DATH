<?php
include 'header.php';
include('connect/myconnect.php');
include ('leftpanel.php') ;
	if(isset($_POST['submit'])){
		$oldpass = md5($_POST['mkcu']);
		$query = mysqli_query($connect, "SELECT MatKhau from tbltaikhoan where MaTK = '{$_SESSION['uid']}' and MatKhau = '$oldpass' ");
		if (mysqli_num_rows($query)==1)
		{
			$pwd = md5($_POST['pass']);
		$result = mysqli_query($connect,"UPDATE tbltaikhoan SET MatKhau='$pwd'");
		if($result){
echo "<script>alert('Đổi mật khẩu thành công!');</script>";
}
}

else{
echo "<script>alert('Đổi mật khẩu không thành công do nhập không đúng mật khẩu cũ!');</script>";
}
}
$connect->close();
?>
<div class="content mt-3">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-xs-8 col-sm-8">
				<div class="card">
					<div class="card-header">
						<strong>ĐỔI MẬT KHẨU</strong>
					</div>
					<div class="card-body card-block">
						<form action="" id="doimatkhau" method="post" class="">
							
							<div class="form-group">
								<label class=" form-control-label">Mật khẩu hiện tại:</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
									<input type="password" name="mkcu" value="" placeholder="Nhập vào mật khẩu cũ" class="form-control" required>
								</div>
								
							</div>
							<div class="form-group">
								<label class=" form-control-label">Mật khẩu mới:</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
									<input type="password" name="pass" id="pass" value="" placeholder="Nhập mật khẩu mới" class="form-control" required>
								</div>
								
							</div>
							<div class="form-group">
								<label class=" form-control-label">Nhập lại mật khẩu:</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
									<input type="password" name="pass2" id="pass2" value="" placeholder="Xác nhận mật khẩu" required class="form-control">
								</div>
							</div>
							<span id="message_pwd"></span>
							<div id="row">
								<div class="submit" style="float: right;margin-right: 1px">
									<button type="submit"  name="submit">
									Lưu thông tin
									</button>
									<button type="reset">
									Đặt lại
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script>
		$(document).ready(function(){
			$("#pass, #pass2").on("keyup",function(){
				var pwd1 = $("#pass").val();
				var pwd2 = $("#pass2").val();
				if(pwd1 != pwd2){
					$("#message_pwd").html("Mật khẩu nhập lại phải trùng !").css("color","red");
				}
				else{
					$("#message_pwd").html("Trùng khớp !").css("color","green");
				}
			});
					$("#doimatkhau").submit(function(e){
				if($("#message_pwd").text() == "Mật khẩu nhập lại phải trùng !" ){
					e.preventDefault();
				}
					});
		});
	</script>
	<?php include 'scriptindex.php'; ?>