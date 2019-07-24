<style>
    .tablenone{
        display: none;
    }
    .table2{
        display: none;
    }
    .themtk{
        display: none;
    }
</style>
<?php include 'header.php';
ob_start();
include('connect/myconnect.php');
include ('leftpanel.php') ;
$i=0;

if (isset($_POST['submit']))
{

    $TenDangNhap = $_POST["TenDangNhap"];
    $HoTen = $_POST["HoTen"];
    $SDT = $_POST["SDT"];
    $TrangThai = 1;
    $password = md5($_POST["password"]);
    $khoa=$_POST['khoa'];
    if(isset($_POST['check']))
    {
        $quyen=$_POST["check"];
        $imp=implode(",",$quyen);
    }
    else
    {
        $imp=" ";
    }
    $query = "INSERT INTO tbltaikhoan(TenDangNhap,MatKhau,HoTen,SDT,MaQH,MaKhoa,TrangThai)VALUES('$TenDangNhap','$password','$HoTen','$SDT','$imp','$khoa','$TrangThai')";
    $result = mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
    if(mysqli_affected_rows($connect)==1)
      {
        echo "<script>alert('Thêm tài khoản thành công')</script>";
        echo("<script>location.href = '"."danh-sach-tai-khoan.php';</script>");
      }
      else
      {
        echo "<script>alert('Thêm tài khoản không thành công')</script>";
        echo("<script>location.href = '"."danh-sach-tai-khoan.php';</script>");
      }  
}

include('vo-hieu-hoa-tai-khoan.php');
include('mo-khoa-tai-khoan.php');
?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">DANH SÁCH TÀI KHOẢN</strong>
                        <!--  <button style="float: left;" type="reset" onclick="goBack()">Trở lại</button> -->
                        <button style="float: right;" type="submit" data-toggle="modal" data-target="#myModala">
                            <span class="fa fa-plus" aria-hidden="true"></span> Thêm tài khoản</a>
                        </button>
                    </div>
                    
                    <div class="card-body">
                        <div >
                            <input type="hidden" name="form[_token]" value="{{ form._token.vars.value }}" />
                            <select class="form-control" name="searchKhoa" id="searchKhoa" text-align-last: center>
                                <option  value="0">--Tất cả bộ phận--</option>
                                <?php
                                 if (isset($_SESSION["DP_LDDV"]) || isset($_SESSION["YCTBVT"]))
                                {
                                	$query_k="SELECT * FROM tblkhoa WHERE MaKhoa = '{$_SESSION['MaKhoa']}'";
                                	$result_k=mysqli_query($connect,$query_k);
                                }
                                else
                                {
                                	$query_k="SELECT * FROM tblkhoa";
                                	$result_k=mysqli_query($connect,$query_k);
                                }
                                while ($item_k=mysqli_fetch_array($result_k,MYSQLI_ASSOC)) {


                                    ?>
                                    <option  value="<?php echo $item_k['MaKhoa'] ?>"><?php echo $item_k['TenKhoa'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <br>
                            
                        </div>
                        
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">STT</th>
                                    <th >Mail</th>
                                    <th >Họ tên</th>
                                    <th >Điện Thoại</th>
                                    <th >Khoa</th>
                                    <th width="2%" >Trạng Thái</th>
                                    <th width="1%" ></th>
                                    <th width="1%"></th>
                                    <th width="1%"></th>
                                </tr>
                            </thead>
                            
                            <tbody id="table">

                                <?php 
                                  if (isset($_SESSION["DP_LDDV"]) || isset($_SESSION["YCTBVT"]))
                                {
                                	$query="SELECT MaTK,TenDangNhap,HoTen,SDT,TenKhoa,TrangThai  FROM tbltaikhoan tk, tblkhoa k  WHERE tk.MaKhoa=k.MaKhoa and tk.MaKhoa = '{$_SESSION['MaKhoa']}' ORDER BY MaTK ASC    ";
                                $result = mysqli_query($connect, $query);
                                }
                                else
                                {
                                	$query="SELECT MaTK,TenDangNhap,HoTen,SDT,TenKhoa,TrangThai  FROM tbltaikhoan tk, tblkhoa k  WHERE tk.MaKhoa=k.MaKhoa ORDER BY MaTK ASC    ";
                                $result = mysqli_query($connect, $query);
                                }
                                
                                $STT=0;
                                while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {

                                    $STT++;
                                    $i++;
                                    ?>
                                    <td><?php echo $STT ?></td>
                                    <td><?php echo $row['TenDangNhap']; ?></td>
                                    <td><?php echo $row['HoTen']  ?></td>
                                    <td><?php echo $row['SDT']  ?></td>
                                    <td><?php echo $row['TenKhoa']?></td>
                                    <?php if($row['TrangThai']==1) { ?>
                                        <td ><span class="badge badge-pill badge-success"> Hoạt động</td>
                                        <?php }else{ ?>
                                            <td><span class="badge badge-pill badge-danger">Bị vô hiệu hóa</td>
                                            <?php }  ?>
                                            <?php if($row['TrangThai']==0) { ?>
                                                <td>
                                                    <a href="vo-hieu-hoa-tai-khoan.php?id=<?php echo $row['MaTK'] ?>" data-toggle="modal" data-target="#myModal<?php echo  $row['MaTK'] ?>">
                                                        <span class="ti-lock" aria-hidden="true"></span></a>
                                                    </td>
                                                <?php } else {  ?>
                                                    <td>
                                                        <a href="mo-khoa-tai-khoan.php?id=<?php echo $row['MaTK'] ?>" data-toggle="modal" data-target="#myModal<?php echo $row['MaTK'] ?>">
                                                            <span class="ti-unlock" aria-hidden="true"></span></a>
                                                        </td>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a  href="chitiet-tai-khoan.php?id=<?php echo $row['MaTK'] ?>"  class="ti-eye"></a>
                                                </td>
                                                <td>
                                                    <a onclick="return confirm('Xác nhận xóa tài khoản !')" href="delete-tai-khoan.php?id=<?php echo $row['MaTK'] ?>" class="ti-trash"></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tbody id="table2">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $query="SELECT MaTK,TenDangNhap,HoTen,SDT,TenKhoa,TrangThai  FROM tbltaikhoan tk, tblkhoa k  WHERE tk.MaKhoa=k.MaKhoa ORDER BY MaTK ASC   ";
        $a=0;
        $b=0;
        $result = mysqli_query($connect, $query);
        while ($row_1=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            $a++;
            $b++;
            if($row_1['TrangThai']==1)
            {
                ?>
                <div class="modal fade" id="myModal<?php echo $row_1['MaTK'] ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body modal-body-sub_agile">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                <div class="card-body card-block">
                                    <h3 class="agileinfo_sign">Vô hiệu hóa tài khoản</h3>
                                    <p style="width: 50px;"></p>

                                    <form action="vo-hieu-hoa-tai-khoan.php?id=<?php echo $row_1['MaTK'] ?>" method="post" >
                                        <div class=" form-group">
                                            <input type="text" placeholder="Lý do vô hiệu hóa" name="lydo" class="form-control">
                                            <p></p>
                                            <button style="background-color: #217346;float:right;"type="submit" name="vohieu">Vô hiệu hóa</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else { ?>
                <div class="modal fade" id="myModal<?php echo $row_1['MaTK'] ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body modal-body-sub_agile">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                                <div class="card-body card-block">
                                    <h3 class="agileinfo_sign">Mở khóa tài khoản</h3>
                                    <p style="width: 50px;"></p>

                                    <form action="mo-khoa-tai-khoan.php?id=<?php echo $row_1['MaTK'] ?>" method="post" >
                                        <div class=" form-group">
                                            <input type="text" placeholder="Lý do mở khóa tài khoản" name="lydo" class="form-control">
                                            <p></p>
                                            <button style="background-color: #217346;float:right;"type="submit" name="mokhoa">Mở khóa
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } }?>
            <div class="modal fade" id="myModala" tabindex="-1" role="dialog">
                <div style="margin: 1em; padding-left: 40vh" class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content" style="width: 1000px;">
                        <div class="modal-body modal-body-sub_agile">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>  
                            <div class="card-body card-block">
                                <h3 class="agileinfo_sign" align="center">TẠO TÀI KHOẢN MỚI</h3>
                                <p style="width: 50px;"></p>
                                <form action="" method="post" id="formcttk" >

                                    <div class=" form-group">
                                        <input type="text" id="TenDangNhap" placeholder="Tên đăng nhập" name="TenDangNhap" required="" class="form-control">
                                        <p id="validate-user" ></p>
                                    </div>
                                    <div class=" form-group">
                                        <select class="form-control" name="khoa" id="">
                                        	<?php  if (!isset($_SESSION["DP_LDDV"]) || !isset($_SESSION["YCTBVT"])){
                                        		  $query="SELECT * FROM tblkhoa WHERE MaKhoa = '{$_SESSION['MaKhoa']}'";
                                            $result=mysqli_query($connect,$query);
                                            while ($item=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                                ?>
                                                <option  value="<?php echo $item['MaKhoa'] ?>"><?php echo $item['TenKhoa'] ?></option>
                                                <?php
                                            }
                                        }
                                            else{
                                        	 ?>
                                            
                                            <option  value="0">--Chọn khoa--</option>
                                        
                                            <?php $query="SELECT * FROM tblkhoa";
                                            $result=mysqli_query($connect,$query);
                                            while ($item=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                                ?>
                                                <option  value="<?php echo $item['MaKhoa'] ?>"><?php echo $item['TenKhoa'] ?></option>
                                                <?php
                                            }
                                        }
                                            ?>
                                        </select>
                                    </div>

                                    <div class=" form-group">
                                        <input type="text" placeholder="Họ tên" name="HoTen" class="form-control">
                                    </div>

                                    <div class=" form-group">
                                        <input type="number" placeholder="Số điện thoại" maxlength = "10" name="SDT" class="form-control">
                                    </div>
                                    <div class=" form-group">
                                        <input type="password" placeholder="Mật khẩu" name="password" id="password" required="" class="form-control">
                                    </div>
                        <!-- <div class=" form-group">
                            <input type="password" placeholder="Xác nhận mật khẩu" name="confirm"  required=""class="form-control">
                        </div> -->
                        <div class="row">
                            <?php 
                            if (isset($_SESSION["DP_LDDV"]) || isset($_SESSION["YCTBVT"]))
                            {
                            	$sql = "SELECT * FROM tblquyenhan WHERE TheoDonVi = 1 ORDER BY TenQH ";
                              $query = mysqli_query($connect, $sql);
                            }
                           else
                           {
                           	 $sql = "SELECT * FROM tblquyenhan ORDER BY TenQH";
                              $query = mysqli_query($connect, $sql);
                           }
                            while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                                ?>
                                <div  class="col-lg-6" >
                                    <input class="checkbox" style="float:right;margin-top: 5px" type="checkbox" value="<?php echo $row['MaQH']; ?>" name="check[]" >
                                    <label style="text-transform: none;"> <span></span><?php echo $row['TenQH']; ?></label>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <button id="them" style="float:right;" type="submit" name="submit" >THÊM TÀI KHOẢN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'scriptindex.php'; ?>
<script src="assets/js/my.js"></script>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script>
 
        $('#searchKhoa' ).on("change",function(){
            var value = $(this).val();
            var $query="SELECT * FROM tbltaikhoan tk, tblkhoa k  WHERE tk.MaKhoa=k.MaKhoa AND  tk.MaKhoa="+value;
            var i=1;
            var temp=0;
            if(value !=0)
            {
                $('#table').addClass("tablenone");
                $('#table2').removeClass("table2");
                $.ajax({
                    url:"search-tai-khoan-thuoc-khoa.php?MaKhoa="+value,
                    method:"GET",
                    dataType:"json",
                    success:function(data)
                    {
                        $("#table2").val("");
                        var html = '';
                        $.each(data, function (key,value) {
                            temp++ ;
                            html += '<tr>';
                            html += '<td >'+i+++'</td>';
                            html += '<td>'+value.TenDangNhap+'</td>';
                            html += '<td>'+value.HoTen+'</td>';
                            html += '<td>'+value.SDT+'</td>';
                            html += '<td>'+value.TenKhoa+'</td>';
                            if(value.TrangThai==1)
                                html += ' <td ><span class="badge badge-pill badge-success">'+'Hoạt động'+'</td>';
                            else
                                html += '<td ><span class="badge badge-pill badge-danger">'+'Bị vô hiệu hóa'+'</td>';
                            if(value.TrangThai==1)
                            {
                                html +='<td><a href="mo-khoa-tai-khoan.php?id='+value.MaTK+'" data-toggle="modal" data-target="#myModal'+temp+++'"><span class="ti-lock" aria-hidden="true"></span></a></td>';  }
                                else{
                                    html +='<td><a href="vo-hieu-hoa-tai-khoan.php?id='+value.MaTK+'" data-toggle="modal" data-target="#myModal'+temp+++'"><span class="ti-unlock" aria-hidden="true"></span></a></td>';   }
                                    html += '<td> <a class="ti-eye"   href="chitiet-tai-khoan.php?id='+value.MaTK+'">'+'</a></td>';
                                    html += '<td><a class="ti-trash" href="delete-tai-khoan.php?id='+value.MaTK+'">'+'</a></td>';
                                    html += '</tr>';
                                });
                        $("#table2").html(html);
                        return false;
                    },
                    error: function(e){
                        $("#table2").html("");
                    }
                });
            }else {
                $('#table').removeClass("tablenone");
                $('#table2').addClass("table2");
            }
        });
   
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
<?php ob_flush(); ?>
