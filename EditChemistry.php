<?php include 'header.php'; ?>
<?php
session_start();
?>
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
    $sql = "UPDATE tblhoachat SET TenHoaChat='$thc',SLT='$slt',DVT='$dvt' WHERE id = {$id} ";
    $query = mysqli_query($connect,$sql);
    $message='Sửa thành công';
    echo "<script type='text/javascript'>alert('$message');</script>";
    }
    ?>
    <?php
    $id = $_GET['id'];
    $sql = "Select MaDanhMuc,TenHoaChat,SLT,DVT from tblhoachat where id={$id}";
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
                                    <div class="col col-sm-5"><label for="input-small" class=" form-control-label">Mã danh mục</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="input-small" value=" <?php echo $row["MaDanhMuc"]; ?>" disabled='true' class="input-sm form-control-sm form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-normal" class=" form-control-label">Tên hóa chất</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="thc" value="<?php echo $row["TenHoaChat"]; ?>"  class="form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-large" class=" form-control-label">Số lượng tồn</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="slt" value="<?php echo $row["SLT"]; ?>"  class="input-lg form-control-lg form-control"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-sm-5"><label for="input-large" class=" form-control-label">Đơn vị tính</label></div>
                                    <div class="col col-sm-6"><input type="text" id="input-normal" name="dvt" value="<?php echo $row["DVT"]; ?>"  class="input-lg form-control-lg form-control"></div>
                                </div>
                                <div class="card-footer">
                                    <input type="submit" name ="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" value="Lưu thông tin">
                                    
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