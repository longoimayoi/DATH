<?php include 'header.php'; ?>

<?php include('connect/myconnect.php');?>
<body>
    <?php include 'leftpanel.php' ; ?>
    <!-- Left Panel -->
    <!-- Right Panel -->
    <!-- /header -->
    <!-- Header-->
    <?php
    $id = $_GET['id'];
    if(($_SERVER['REQUEST_METHOD']=='POST')){
    $thc = $_POST["thc"];
    $slt = $_POST["slt"];
    $dvt = $_POST["dvt"];
    $vitridat = $_POST["vitridat"];
    $thongsokt = $_POST["thongsokt"];
    $xuatxu = $_POST["xuatxu"];
    $ngaymonap = $_POST["ngaymonap"];
    $ngayhethan = $_POST["ngayhethan"];
    $hsdsmn = $_POST["hsdsmn"];
    $sql = "UPDATE tblhoachat SET TenHoaChat='$thc',SLT='$slt',DVT='$dvt', ViTriDat='$vitridat',ThongSoKT='$thongsokt',XuatXu='$xuatxu',NgayMoNap='$ngaymonap',NgayHetHan='$ngayhethan',SoNgayHetHanSMN='$hsdsmn' WHERE id = {$id} ";
    $query = mysqli_query($connect,$sql);
    $message='Sửa thành công';
    echo "<script type='text/javascript'>alert('$message');</script>";
    }
    ?>
    <?php
    $id = $_GET['id'];
    $sql = "Select * from tblhoachat where id={$id}";
    $result = mysqli_query($connect, $sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    ?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <strong>Sửa thông tin</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Mã vật tư</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="input-small" value=" <?php echo $row["MaVatTu"]; ?>" disabled='true' class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Tên vật tư</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="thc" value="<?php echo $row["TenHoaChat"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Số lượng tồn</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="slt" value="<?php echo $row["SLT"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Đơn vị tính</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="dvt" value="<?php echo $row["DVT"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Vị trí đặt</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="vitridat" value="<?php echo $row["ViTriDat"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Thông số kĩ thuật</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="thongsokt" value="<?php echo $row["ThongSoKT"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Xuất xứ</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="xuatxu" value="<?php echo $row["XuatXu"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Ngày mở nắp</label></div>
                                    <div class="col col-sm-6"><input placeholder="yyyy-mm-dd" type="text" id="input-normal" name="ngaymonap" value="<?php echo $row["NgayMoNap"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Ngày hết hạn</label></div>
                                    <div class="col col-sm-6"><input placeholder="yyyy-mm-dd" type="text" id="input-normal" name="ngayhethan" value="<?php echo $row["NgayHetHan"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Hạn sử dụng sau mở nắp</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="hsdsmn" value="<?php echo $row["SoNgayHetHanSMN"]; ?>"  class="form-control"></div>
                                </div>
                                <div style="float: right;" class="row">
                                    <button type="submit" name ="submit" >Lưu thông tin</button>
                                    
                                </div>
                            </form>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Panel -->
    <?php include 'scriptindex.php'; ?>
</body>
</html>