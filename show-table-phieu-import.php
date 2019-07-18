<?php include 'header.php'; 
  include('connect/myconnect.php');
   include 'leftpanel.php' ;
     $MaHD=$_GET['MaHD'];
     $i=1;
 
    ?>
    
  <div class="container">  
    <br />
    <div class="table-responsive" >  
      <div style="display: flex">
       
         <!--  <a class="btn btn-info" href="cap-nhat-table-import.php?ngaylap=<?php echo $ngaylap ?>">Chỉnh sửa</a> -->
           <input type="button" id="savedl" onclick="window.location.href='cap-nhat-table-import.php?MaHD=<?php echo $MaHD ?>'" value="Chỉnh sửa"/>

          <input type="button" id="savedl" onclick="window.location.href='save-all-import.php?MaHD=<?php echo $_GET['MaHD']?>'" value="Xong"/></a>
      
    </div> 
<form method="post">
    
        <br />
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <th>STT</th>
              <th width="">Mã Vật tư</th>
              <th width="20%">Tên Vật tư</th>
              <th width="10%">Đơn vị tính</th>
              <th width="10%">Số lượng</th>
              <th width="20%">Thông số KT</th>
              <th width="20%">Xuất xứ</th>
              <th width="20%">Ghi chú</th>
            </thead>
             <?php $query="SELECT * FROM tblphieuyeucautrangbi WHERE MaHD='$MaHD'";
                    $result=mysqli_query($connect,$query);
                    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
               ?>
            <tbody>
             
               <td><?php echo $i++; ?></td>
               <td><?php echo $row['MaVatTu'] ?></td>
                <td><?php echo $row['TenVatTu'] ?></td>
                <td><?php echo $row['DVT'] ?></td>
                <td><?php echo $row['SL'] ?></td>
                <td><?php echo $row['ThongSoKT'] ?></td>
                <td><?php echo $row['XuatXu'] ?></td>
                <td><?php echo $row['GhiChu'] ?></td>
             
            </tbody>
             <?php  } ?>
          </table>
        </div>
      </form>
       
        </div>  
  </div>
    <?php include 'scriptindex.php'; ?>
</body>  

</html>