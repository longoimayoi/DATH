<?php include 'header.php';
 include('connect/myconnect.php'); 
 include 'leftpanel.php' ; 
    if(isset($_POST["btn_save"])){
    $ht = $_POST["ht"];
    $dt = $_POST["dt"];
    $sql = "UPDATE tbltaikhoan SET HoTen='$ht',SDT='$dt' WHERE MaTK = '{$_SESSION['uid']}' ";
    $query = mysqli_query($connect,$sql);
    echo "<script type='text/javascript'>alert('Lưu thông tin thành công !');</script>";
    }
    ?>
    <?php
    $sql = "Select * from tbltaikhoan where MaTK='{$_SESSION['uid']}'";
    $result = mysqli_query($connect, $sql);
     $row=mysqli_fetch_array($result);
         $a=$row['MaQH'];
        $qh=explode(',', $a);

    ?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-6" style="margin: 0 auto">
                    <div class="card" >
                        <div class="card-header">
                            <strong>CẬP NHẬT THÔNG TIN TÀI KHOẢN</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="" id="formtt">
                                <div class="form-group">
                                    <label class=" form-control-label">Email đăng nhập:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                        <input disabled value ="<?php echo $row["TenDangNhap"]; ?>" name = "tdn" required class="form-control">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class=" form-control-label">Họ Tên:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                        <input type="text" value ="<?php echo $row["HoTen"]; ?>" name ="ht" required class="form-control">
                                    </div>
                                    
                                </div>
                                <div class="form-group" >
                                    <label class=" form-control-label">Số điện thoại</label>
                                    <div  class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input  type="number" value ="<?php echo $row["SDT"]; ?>" maxlength = "10" name ="dt" required class="form-control ">
                                    </div>
                                </div>
                                <br>
                                <div class=" form-group"  >
                                   <?php  $sql = "SELECT * FROM tblquyenhan ORDER BY TenQH";
                                   $query = mysqli_query($connect, $sql);
                                   while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
                                   {
                                    ?>
                                    <div >
                                        
                                  <input disabled="" class="checkbox" style="float:right;" type="checkbox" value="<?php  echo $row['MaQH'] ?>" name="check[]"  <?php
                                      if(in_array($row["MaQH"],$qh))
                                      {
                                        echo "checked";
                                      }
                                      ?> />
                                    
                                      <label >
                                       <?php echo $row['TenQH']; ?>
                                     </label>
                                   </div>
                                 <?php } ?>
                               </div>
                                <div id="row">
                                    <div class="submit" style="float: right;margin-right: 1px">
                                        <button type="submit" name="btn_save">
                                        Lưu thông tin
                                        </button>
                                        <button type="reset">
                                        Đặt lại
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    <br>
    
    <!-- Right Panel -->
    <?php include 'scriptindex.php'; ?>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
      $('#formtt').validate({
      rules:{
                  dt:{
                      maxlength:10,minlength:10,
                  },
              },
             messages:{
                  dt:{
                      maxlength:'Không được lớn hơn 10 ký tự',minlength:'Không được nhỏ hơn 10 ký tự',
                  },
              },
       });

      });
  </script>