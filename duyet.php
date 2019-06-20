<?php ob_start(); ?>
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
    
    <?php include ('leftpanel.php');
    include('connect/myconnect.php');
    $id=$_GET['id'];
    if(isset($_POST['submit']))
    {
    $slton=$_POST['slton'];
    $dvtinh=$_POST['dvtinh'];
    $chatlieu=$_POST['chatlieu'];
    $quycach=$_POST['quycach'];
    
    $query="SELECT * FROM tblhoachat WHERE id=$id ";
    $result=mysqli_query($connect,$query);
    $hoachat=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $query1="SELECT * FROM tbldungcutn WHERE MaDungCu=$id ";
    $result1=mysqli_query($connect,$query1);
    $dungcu=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    if($id==$dungcu['MaDungCu'])
    {
    
    $query_tn="UPDATE tbldungcutn SET SLT=$slton,DVT='$dvtinh',ChatLieu='$chatlieu',QuyCach='$quycach' ,TrangThai=1 WHERE MaDungCu=$id";
    $result_tn=mysqli_query($connect,$query_tn);
    header('Location:list_choduyet.php');
    }
    if($id==$hoachat['id'])
    {
    
    $query_hc="UPDATE tblhoachat SET SLT=$slton,DVT='$dvtinh', TrangThai=1 WHERE id=$id";
    $result_hc=mysqli_query($connect,$query_hc);
    header('Location:list_choduyet.php');
    
    }
    $query_id="SELECT MaDanhMuc,TenHoaChat,SLT,DVT,TrangThai FROM tblhoachat WHERE id={$id}";
    $result_id=mysqli_query($connect,$query_id)or die("Query_id {$query} \n <br> MySql erros:".mysqli_errno($connect));
    if(mysqli_num_rows($result_id)==1)
    {
    //danh sách để lấy dữ liệu
    list($MaDanhMuc,$TenHoaChat,$SLT,$DVT,$TrangThai,)=mysqli_fetch_array($result_id,MYSQLI_NUM);
    }
    
    }
    ?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                
                <div class="col-xs-6 col-sm-6">
                    <div class="card" style="width: 1150px;">
                        <div class="card-header">
                            <strong>Duyệt </strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="">
                                
                                <?php
                                $query1="SELECT * FROM tbldungcutn WHERE MaDungCu=$id ";
                                $result1=mysqli_query($connect,$query1);
                                while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC))
                                {
                                if($id==$row['MaDungCu'])
                                {
                                $query="SELECT * FROM tbldanhmuc WHERE MaDanhMuc= ".$row['MaDanhMuc']."";
                                $result=mysqli_query($connect,$query);
                                while ($item=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                
                                ?>
                                <div class="form-group">
                                    <label  class=" </p>form-control-label">Tên hóa chất hoặc dụng cụ TN</label>
                                    <div class="wrapper">
                                        <div>
                                            <input type="text" name="ten"  disabled=""
                                            value="<?php echo $row['TenDungCu'] ?>"  class="form-control"  >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label  class=" </p>form-control-label">Thuộc danh mục</label>
                                    <div class="wrapper">
                                        <div>
                                            <input type="text" name="ten"  disabled=""
                                            value="<?php echo $item['TenDanhMuc'] ?>"  class="form-control"  >
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
                                <div class="card-footer">
                                    <!--  <button type="submit" name="btn_submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Lưu
                                    </button> -->
                                    <input  class="btn btn-primary btn-sm" type="submit" name="submit" value="Duyệt">
                                    
                                    <a  onclick=" return confirm('bạn có muốn xóa');" class="btn btn-danger btn-sm" href="delete_denghi.php?id=<?php echo $row['MaDungCu']; ?>">Xóa
                                    </a>
                                </div>
                                <?php
                                }}
                                }
                                $query="SELECT * FROM tblhoachat WHERE id=$id ";
                                $result1=mysqli_query($connect,$query);
                                while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC))
                                {
                                if($id==$row['id'])
                                {
                                $query="SELECT * FROM tbldanhmuc WHERE MaDanhMuc= ".$row['MaDanhMuc']."";
                                $result=mysqli_query($connect,$query);
                                while ($item=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                ?>
                                <div class="form-group">
                                    <label  class=" </p>form-control-label">Tên hóa chất hoặc dụng cụ TN</label>
                                    <div class="wrapper">
                                        <div>
                                            <input type="text" name="ten"  disabled=""
                                            value="<?php echo $row['TenHoaChat'] ?>"  class="form-control"  >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label  class=" </p>form-control-label">Thuộc danh mục</label>
                                    <div class="wrapper">
                                        <div>
                                            <input type="text" name="ten"  disabled=""
                                            value="<?php echo $item['TenDanhMuc'] ?>"  class="form-control"  >
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
                                <div class="card-footer">
                                    <!--  <button type="submit" name="btn_submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Lưu
                                    </button> -->
                                    <input  class="btn btn-primary btn-sm" type="submit" name="submit" value="Duyệt">
                                    
                                    <a  onclick=" return confirm('bạn có muốn xóa');" class="btn btn-danger btn-sm" href="delete_denghi.php?id=<?php echo $row['id']; ?>">Xóa
                                    </a>
                                </div>
                                <?php }}} ?>
                                
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
<?php ob_flush(); ?>