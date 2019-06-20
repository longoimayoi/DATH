<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');
include('connect/function.php');
?>
<style type="text/css">
.required{
color: red;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<body>
    <?php include ('leftpanel.php') ;
    if(($_SERVER['REQUEST_METHOD']=='POST'))
    {
    $tenhc=$_POST['tendc'];
    $slton=$_POST['slton'];
    $dvtinh=$_POST['dvtinh'];
    $chatlieu=$_POST['chatlieu'];
    $quycach=$_POST['quycach'];
    if($slton < 0)
    {
    echo "<script>alert('Số lượng phải lớn hơn 0')</script>";
    }
    else if(is_numeric($dvtinh))
    {
    echo "<script>alert('Đơn vị tính phải là kiểu chuỗi')</script>";
    }
    else
    {
    if($_POST['parent']==0)
    {
    $parent=0;
    }
    else
    {
    $parent=$_POST['parent'];
    }
    $query="INSERT INTO tbldungcutn(MaDanhMuc,TenDungCu,SLT,DVT,ChatLieu,QuyCach) VALUES
    ('$parent','$tenhc','$slton','$dvtinh','$chatlieu','$quycach')";
    $result=mysqli_query($connect,$query);
    if(mysqli_affected_rows($connect)==1)
    {
    echo "<script>alert('Thêm thành công')</script>";
    
    
    }
    
    }
    
    
    }
    
    ?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>THÊM DỤNG CỤ - VẬT TƯ</strong>
                        </div>
                        <div class="card-body card-block">
                            
                            <form action="" method="post" class="" id='add_dc'>
                                
                                <div class="form-group">
                                    <label  class=" </p>form-control-label">Tên dụng cụ - vật tư</label>
                                    <div class="wrapper">
                                        <div>
                                            <input type="text" name="tendc" value="" placeholder="Nhập tên dụng cụ - vật tư"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class=" </p>form-control-label">Danh mục</label>
                                    <div class="wrapper">
                                        <div>
                                            <?php hienthi('parent','class','id'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" </p>form-control-label">Số lượng </label>
                                    <div class="wrapper">
                                        <div>
                                            <input type="number" value="" name="slton" placeholder="Số lượng "class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" </p>form-control-label">Đơn vị tính</label>
                                    <div class="wrapper">
                                        <div>
                                            <input type="text" value="" name="dvtinh" placeholder="Đơn vị tính"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class=" </p>form-control-label">Chất liệu</label>
                                    <div class="wrapper">
                                        <div>
                                            <input type="text" name="chatlieu" value="" placeholder="Nhập tên chất liệu"class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class=" </p>form-control-label">Quy cách sử dụng</label>
                                    <div class="wrapper">
                                        <div>
                                            <textarea type="text" name="quycach" value="" placeholder="Quy cách sử dụng"class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--                                     <div class="card-footer">
                                    
                                    <input onclick="return confirm('bạn có thật sự muốn lưu');"  class="btn btn-primary btn-sm" type="submit" name="submit" value="Lưu">
                                    <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Đặt lại
                                    </button>
                                </div> -->
                                <div id="row" >
                                    <div class="submit" style="float: right;margin-right: 1px">
                                        <button onclick="return confirm('Xác nhận lưu dữ liệu');" type="submit" name="submit" >
                                        Lưu
                                        </button>
                                        <button type="reset" >
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
    <?php include ('scriptindex.php'); ?>
</body>
</html>