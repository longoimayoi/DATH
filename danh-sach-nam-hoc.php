<?php include 'header.php';
include('connect/myconnect.php');
include 'leftpanel.php' ;

if(isset($_POST['them']))
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
   $namhoc=date("Y").'-'.(date("Y")+1);
   $query="INSERT INTO namhoc (NamHoc)VALUES('$namhoc')";
   $result=mysqli_query($connect,$query);
    if(mysqli_affected_rows($connect)==1)
      {
        echo "<script>alert('Thêm năm học thành công')</script>";
          echo("<script>location.href = '"."danh-sach-nam-hoc.php';</script>");
      }
      else
      {
        echo "<script>alert('Thêm không thành công')</script>";
          echo("<script>location.href = '"."danh-sach-nam-hoc.php';</script>");
      }
}

?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">DANH SÁCH NĂM HỌC</strong>
                        <form action="" method="post">
                       <button style="float: right;" type="submit" name="them" onclick="return confirm('Bạn có muốn thêm?')">
                        <span class="fa fa-plus" aria-hidden="true"></span> Thêm năm học
                        </button> 
                        </form>
                    </div>
                   <!--   <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">hiển thị</button> -->
                    <div class="card-body" >
                        <table  id="bootstrap-data-table-export"  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="colo">Năm học</th>
                                    <th ></th>
                                    
                                </tr>
                            
                            </thead>
                            <tbody>
                              <?php 
                                      $query="SELECT * FROM namhoc ORDER BY id DESC ";
                                        $result = mysqli_query($connect, $query);
                                    
                                  $i=1;
                                 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                 { 
                                  
                                ?>
                                   <tr>
                                <td ><?php echo $i++ ?></td>
                                <td  ><?php echo $row['NamHoc'] ?></td>
                                <td></td>
                        </tr>
                        <?php } ?>   
                             
                    </tbody>
                    
                </table>
                
            </div>
        </div>
    </div>
</div>
</div>
</div>

</div>
<?php include 'scriptindex.php'; ?>
</body>
</html>
