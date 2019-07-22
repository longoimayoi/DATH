<?php include 'header1.php'; ?>
<?php include('connect/myconnect.php');?>
<body>
    <?php include 'leftpanel.php' ; ?>
    <!-- Left Panel -->
    <!-- Right Panel -->
    <!-- /header -->
    <!-- Header-->
    <!-- Right Panel -->
    <?php
    include('connect/myconnect.php');
    ?>
    
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <?php
                $id=$_GET['MaDanhMuc'];
                $query="SELECT TenDanhMuc FROM tbldanhmuc WHERE MaDanhMuc={$id}";
                $results=mysqli_query($connect,$query);
                $row = mysqli_fetch_assoc ($results);
                ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">CHI TIẾT DANH MỤC <span style="text-transform:uppercase;color:blue" > <?php echo $row['TenDanhMuc']; ?> </span></strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã vật tư</th>
                                        <!--  <th scope="col">First</th>
                                        <th scope="col">Last</th> -->
                                        <th scope="col">Tên vật tư</th>
                                        <th scope="col">Số lượng tồn</th>
                                        <th scope="col">Đơn vị tính</th>
                                        <th style="width: 30px" scope="colo"></th>
                                        <th style="width: 30px" scope="colo"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id=$_GET['MaDanhMuc'];
                                    $query="SELECT * FROM tblhoachat WHERE MaDanhMuc={$id}";
                                    $results=mysqli_query($connect,$query);
                                    while ($row=mysqli_fetch_array($results,MYSQLI_ASSOC))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['MaVatTu'] ?></td>
                                        <td><?php echo ($row['TenHoaChat']);?></td>
                                        <td><?php echo ($row['SLT']);?></td>
                                        <td><?php echo ($row['DVT']);?></td>
                                        <td>
                                            <a href="EditChemistry.php?id=<?php echo $row['id']; ?>">
                                            <img style="width: 30px" src="images/sua.png"></a>
                                        </td>
                                        <td>
                                            <a onclick=" return confirm('bạn có muốn xóa');"  href="delete_hoachat.php?id=<?php echo $row['id']; ?>">
                                            <img style="width: 30px" src="images/delete.png"></a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>'
                </div>
            </div>
            </div><!-- .animated -->
        </div>
        <?php include 'scriptindex.php'; ?>
    </body>
</html>
<!-- <script type="text/javascript">
$(".remove").click(function(){
var id = $(this).parents("tr").attr("id");
if(confirm('Are you sure to remove this record ?'))
{
$.ajax({
url: '/delete_category.php',
type: 'GET',
data: {id: id},
error: function() {
alert('Something is wrong');
},
success: function(data) {
$("#"+id).remove();
alert("Record removed successfully");
}
});
}
});
</script> -->