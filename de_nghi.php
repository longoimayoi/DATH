
<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');
    include('connect/function.php');
   
?>
   <style type="text/css">
    .required{
        color: red;
    }
 </style>
<script src="js/jquery-3.3.1.min.js"></script>
<body>

    <?php include ('leftpanel.php') ;  
    if($_SERVER['REQUEST_METHOD']=='POST')
    {   
        $error=array();
        if(empty($_POST['ten']))
        {
            $error="chưa nhập tên";
        }
        else
        {
            $ten=$_POST['ten'];
        }
        $trangthai=$_POST['trangthai'];
        if($_POST['parent']==0)
        { 
            $danhmuc=0;
        }
        else
        {
            $danhmuc=$_POST['parent'];
        }
        if(empty($error))
        {
            $query="SELECT MaDanhMuc FROM tblhoachat WHERE MaDanhMuc='$danhmuc'";
            $result=mysqli_query($connect,$query);
            $hoachat=mysqli_fetch_array($result,MYSQLI_ASSOC);

            
            if($danhmuc==$hoachat['MaDanhMuc'])
            {
                $query_hc="INSERT INTO tblhoachat(MaDanhMuc,TenHoaChat,TrangThai) VALUES ('$danhmuc','$ten',$trangthai) 
                ";
                $result_hc=mysqli_query($connect,$query_hc);
                if(mysqli_affected_rows($connect)==1)
                {
                    $message="<p class='required'>thêm thành công</p>";
                }
                else
                {
                    $message="<p class='required'>không thành công</p>";
                }
                
            }
            else 
            {
                $query_dc="INSERT INTO tbldungcutn(MaDanhMuc,TenDungCu,TrangThai) VALUES('$danhmuc','$ten',$trangthai) 
                ";
                $result_dc=mysqli_query($connect,$query_dc);
                if(mysqli_affected_rows($connect)==1)
                {
                    $message="<p class='required'>thêm thành công</p>";
                }
                else
                {
                    $message="<p class='required'>không thành công</p>";
                }
            }
        }
    }
    ?>
               
  <?php 
      if(isset($message))
        {
            echo $message;
        }
       ?>
    <div class="content mt-3">

            <div class="animated fadeIn">
                <div class="row">
      
                    <div class="col-xs-6 col-sm-6">
                         <div class="card">
                            <div class="card-header">
                                <strong>Đề nghị bổ sung</strong>
                            </div>    
                            <div class="card-body card-block">
                              
                                <form action="" method="post" class="">
                                  
                                    <div class="form-group">
                                        <label  class=" </p>form-control-label">Thuộc danh mục</label>
                                        <div class="wrapper">
                                            <div>
                                                <?php hienthi('parent','class') ?>
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="form-group">
                                        <label  class=" </p>form-control-label">Tên dụng cụ TN hoặc hóa chất đang thiếu</label>
                                        <div class="wrapper">
                                            <div>
                                                <input type="text" name="ten" value="" placeholder="Nhập "class="form-control" required>
                                                <?php 
                                                    if(isset($error))
                                                    {
                                                        echo 'hãy nhập tên';
                                                    }
                                                ?>
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="form-group">
                                        <label  class=" </p>form-control-label">Trạng thái</label>
                                        <div class="wrapper">
                                            <div>
                                                <label><input type="radio" checked="true" name="trangthai" value="0" >  Chưa có</label>
                                                
                                            </div>
                                        </div>   
                                    </div>
                                     
                                    <div class="card-footer">
                                       <!--  <button type="submit" name="btn_submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Lưu 
                                        </button> -->
                                        <input onclick="return confirm('bạn có thật sự muốn lưu');"  class="btn btn-primary btn-sm" type="submit" name="submit" value="Lưu">
                                        
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
         </div>
   <?php include 'scriptindex.php'; ?>
</body>
</html>
