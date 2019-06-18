<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');?>
<body>
    <?php include 'leftpanel.php' ; ?>
    <!-- Left Panel -->
    <!-- Right Panel -->
    <!-- /header -->
    <!-- Header-->
    <!-- Right Panel -->
    
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">DANH MỤC</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã danh mục</th>
                                        <!--  <th scope="col">First</th>
                                        <th scope="col">Last</th> -->
                                        <th scope="col">Tên danh mục</th>
                                        <th style="width: 30px" scope="colo"></th>
                                        <th style="width: 30px" scope="colo"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM tbldanhmuc  ";
                                    $result = mysqli_query($connect, $sql);
                                    
                                    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['MaDanhMuc'] ?></td>
                                        <td><a href="detail.php?MaDanhMuc=<?php echo $row['MaDanhMuc']; ?>"><?php echo ($row['TenDanhMuc']);?></a></td>
                                        <!-- <td>
                                            <a href="EditChemistry.php">
                                            <img style="width: 30px" src="images/sua.png"></a>
                                        </td> -->
                                        <td>
                                            <a onclick=" return confirm('bạn có muốn xóa');"  href="delete_category.php?id=<?php echo $row['MaDanhMuc']; ?>">
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