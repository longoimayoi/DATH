<?php include 'header.php'; ?>
<body>
    <?php include 'leftpanel.php' ; ?>
    <?php
    include('connect/function.php');
    $id=$_GET['id'];
    $query="SELECT * FROM monhoc WHERE id=".$id;
    $result = mysqli_query($connect, $query);
    $item = mysqli_fetch_assoc($result);
    if(isset($_POST['update']))
    {
    $MaMon = $_POST["mamon"];
    $TenMon = $_POST["tenmon"];
    $HeSoK = $_POST["hesok"];
    $SoTinChi = $_POST["sotinchi"];
    $sql1 = "UPDATE monhoc set  MaMon='$MaMon', TenMon='$TenMon',HeSoK='$HeSoK',SoTinChi='$SoTinChi'WHERE id=$id";
    $query = mysqli_query($connect,$sql1);
    if(mysqli_affected_rows($connect)==1)
    {
    echo "<script>alert('Sửa môn học thành công')</script>";
    echo"<script>window.location.reload()</script>";
    }
    }
    ?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>CHỈNH SỬA THÔNG TIN MÔN <?php echo $item['MaMon'] ?></strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mã môn học:</label></div>
                                    <div class="col-12 col-md-9"><input type="text"  name="mamon" value="<?php echo $item['MaMon'] ?>" class="form-control"></div>
                                </div>
                                <!-- <hr> -->
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="email-input" class=" form-control-label">Tên môn học</label></div>
                                    <div class="col-12 col-md-9"><input type="text"  name="tenmon" value="<?php echo $item['TenMon'] ?>" class="form-control">
                                </div>
                            </div>
                            <!-- <hr> -->
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="password-input" class=" form-control-label">Hệ số K</label></div>
                                <div class="col-12 col-md-9"><input type="text"  name="hesok" value="<?php echo $item['HeSoK'] ?>" class="form-control">
                            </div>
                        </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="password-input" class=" form-control-label">Số tín chỉ</label></div>
                                <div class="col-12 col-md-9"><input type="text"  name="sotinchi" value="<?php echo $item['SoTinChi'] ?>" class="form-control">
                            </div>
                        </div>
                        <div id="row" >
                            <div class="submit" style="float: right;margin-right: 1px">
                                <button type="submit" name="update" >
                                Lưu
                                </button>
                                <button type="reset" name="delete">
                                Xóa
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <?php include 'scriptindex.php'; ?>
        <script src="assets/js/my.js"></script>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>