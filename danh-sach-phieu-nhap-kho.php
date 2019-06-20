<?php include 'header.php'; ?>
<body>
    <?php include 'leftpanel.php' ; 
if(isset($_POST['submit']))
{
   date_default_timezone_set('Asia/Ho_Chi_Minh');
   $NguoiLap=$_SESSION['uid'];
   $NgayLapPhieu=$_POST['NgayLap'];
   $GhiChu=$_POST['GhiChu'];
   $NgayLap = date("Y-m-d h:i:s", strtotime($NgayLapPhieu));
   $sql1 = "INSERT INTO tbl_phieunhapkho(NguoiLap,NgayLapPhieu,GhiChu)
   VALUES('$NguoiLap','$NgayLap','$GhiChu')";
   $query = mysqli_query($connect,$sql1);
   if(mysqli_affected_rows($connect)==1)
   {
     $id=mysqli_insert_id($connect);
     echo("<script>location.href = '"."chi-tiet-phieu-nhap-kho.php?id=$id';</script>");
 }
 else
 {
           // echo "<script>alert('Lập phiếu không thành công')</script>";
 }
}
    ?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-sm-3">

                 <div class="card-body text-secondary"><button style="background:transparent;border: 1.65px solid #007bffeb"type="submit"data-toggle="modal" data-target="#taophieuxuat">   <i style="color: #007bffeb"class="fa fa-plus" aria-hidden="true"></i></button></div>

             </div>
             <div class="col">

                <button style="display: none">X</button>
            </div>
                   <!--  <div style="margin-right: 14px">
                        
                        <div class="card-body text-secondary"><button for="file-upload" style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"> Chọn</i> </button>
                            <input id="file-upload" type="file" name="file" multiple style='display: none;'>
                            <button type="submit" name="import">Nhập excel</button>
                        <button type="submit" name="import">Xuất excel</button></div>
                        
                    </div> -->
                    
                </div>

            </div>
                <!--
                <div style="height: 60px;margin:0 auto">
                    
                    
                    
                    
                </div> -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">DANH SÁCH VẬT TƯ NHẬP KHO</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Số thứ tự</th>
                                        <th>Người lập phiếu</th>
                                        <th>Ngày lập phiếu</th>
                                        <th>Ghi chú</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $soTT = 0;
                                  $sql = "SELECT MaPhieu, TenDangNhap, NgayLapPhieu, GhiChu FROM tbl_phieunhapkho pnk, tbltaikhoan tk WHERE pnk.NguoiLap = tk.MaTK ORDER BY NgayLapPhieu";
                                  $query = mysqli_query($connect, $sql);
                                  while ($row = mysqli_fetch_array($query)) {
                                    $soTT ++;
                                    ?>
                                    <tr>
                                        <td><?php echo $soTT ?></td>
                                        <td><?php echo $row[1] ?></td>
                                        <td><?php echo $row[2] ?></td>
                                        <td><?php echo $row[3] ?></td>
                                        <td>
                                            <a title="Xem chi tiết" href="chi-tiet-phieu-nhap-kho.php?id=<?php echo $row['MaPhieu'] ?>"  class="ti-eye"></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
<!-----====================================================================================================--->
<!-----========================================POPUP THÊM PHIẾU NHẬP KHO==================================--->

<div class="modal fade" id="taophieuxuat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="max-width: 800px!important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                <label style="margin: 0 auto">LẬP PHIẾU NHẬP KHO</label>
                        <!--    <input type="checkbox" id="checkedit" name="edit">
                            <button  style="background-color: #217346" type="submit" name="edit" id="show" class="hidden">Sửa</button> -->
                        </div>
                        <div class="modal-body" >
                            <form method = "post" >
                                <div id="checkopenedit">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label class="form-control-label">Người lập phiếu:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" name="NguoiLap" class="form-control" value = "<?php echo $_SESSION['Username'] ?>"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Ngày lập phiếu:</label></div>
                                        <div class="col-12 col-md-9"><input type="text"class="form-control" name="NgayLap" value ="<?php  date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("d/m/Y h:i:s") ?>"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label  class=" form-control-label">Ghi chú:</label></div>
                                        <div class="col-12 col-md-9"><input type="text" name="GhiChu"class="form-control"></div>
                                    </div>
                               <!--      <div class="row form-group">
                                        <div class="col col-md-3"><label  class=" form-control-label">Tổng số mặt hàng:</label></div>
                                        <div class="col-12 col-md-9"><input type="text"class="form-control"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label class=" form-control-label">Tổng khối lượng:</label></div>
                                        <div class="col-12 col-md-9"><input type="text"class="form-control"></div>
                                    </div> -->
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                        <button type="submit" name = "submit" class="btn btn-primary">Lập phiếu</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-----===============================================SCRIPT===============================================--->
            <script>
                $('.addfiles').on('click', function() { $('#file-upload').click();return false;});
            </script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('input[type="file"]').change(function(e){
                        var fileName = e.target.files[0].name;
                        $(this).prev('button').text(fileName);
                    });
                });
            </script>
            <script src="vendors/jquery/dist/jquery.min.js"></script>
            <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
            <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="assets/js/main.js"></script>
            <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
            <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
            <script src="vendors/jszip/dist/jszip.min.js"></script>
            <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
            <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
            <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
            <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
            <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
            <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
            <!-----====================================================================================================--->
        </body>