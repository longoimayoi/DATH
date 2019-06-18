<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');?>
<body>
    <?php include 'leftpanel.php' ;
    $dem=0;
    $dem1=0; ?>
    
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div align="left">
                <a href="list_choduyet.php"><button type="submit">Làm mới trang</button></a>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">DANH SÁCH CHỜ DUYỆT</strong>
                        </div>
                        <div class="card-body">
                            <table  class="table bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã</th>
                                        <th scope="col">Tên hóa chất hoặc dụng cụ TN</th>
                                        <th scope="col">Trạng thái</th>
                                        <th style="width: 30px" scope="colo"></th>
                                        <th style="width: 30px" scope="colo"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $sql = "SELECT * FROM tblhoachat WHERE TrangThai=0 ORDER BY id DESC ";
                                    $result = mysqli_query($connect, $sql);
                                    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo ($row['TenHoaChat']); ?></td>
                                        <?php
                                        
                                        if($row['TrangThai']==0)
                                        {
                                        $dem++;
                                        ?>
                                        <td>Chờ duyệt</td>
                                        <?php
                                        
                                        }
                                        else
                                        {
                                        $dem=0;
                                        }
                                        
                                        ?>
                                        <td style="width: 65px;">
                                            <a href="duyet.php?id=<?php echo $row['id'] ?>">
                                            <img style="width: 35px;margin-top: -8px;" src="images/yes.png"></a>
                                        </td>
                                        <td style="width: 65px;">
                                            <a onclick=" return confirm('bạn có muốn xóa');"  href="delete_denghi.php?id=<?php echo $row['id']; ?>">
                                            <img style="width: 30px" src="images/delete.png"></a>
                                        </td>
                                        
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $sql1 = "SELECT * FROM tbldungcutn WHERE TrangThai=0 ORDER BY MaDungCu DESC ";
                                    $result1 = mysqli_query($connect, $sql1);
                                    while ($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC))
                                    
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $row1['MaDungCu'] ?></td>
                                        <td><?php echo ($row1['TenDungCu']); ?></td>
                                        
                                        <?php
                                        
                                        if($row1['TrangThai']==0)
                                        {
                                        $dem1++;
                                        ?>
                                        <td>Chờ duyệt</td>
                                        <?php
                                        
                                        }
                                        else
                                        {
                                        $dem1=0;
                                        }
                                        
                                        ?>
                                        <td style="width: 65px;">
                                            <a href="duyet.php?id=<?php echo $row1['MaDungCu'] ?>">
                                            <img style="width: 35px;margin-top: -8px;" src="images/yes.png"></a>
                                        </td>
                                        <td style="width: 65px;">
                                            <a  onclick=" return confirm('bạn có muốn xóa');"  href="delete_denghi.php?id=<?php echo $row1['MaDungCu']; ?>">
                                            <img style="width: 30px" src="images/delete.png"></a>
                                        </td>
                                        
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    
                                </tbody>
                                <?php  $_SESSION['dem']=$dem1+$dem;
                                ?>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'scriptindex.php'; ?>
</body>
</html>