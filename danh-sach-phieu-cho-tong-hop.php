<style>
    .overflow{
    
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 200px;
    }
    .overflow:hover { 
    overflow: visible;
    white-space: pre-line;
    width: 500px;
    }
</style>
<?php include 'header.php';
include('connect/myconnect.php');
include 'leftpanel.php' ;
$i=0;


?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">DANH SÁCH PHIẾU CHỜ TỔNG HỢP</strong>
            

                    </div>
                   <!--   <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">hiển thị</button> -->
                    <div class="card-body" >
                        <table  id="bootstrap-data-table-export"  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th >Người lập phiếu</th>
                                    <th  style="display: table-caption;width: 200px;height: 22px">Mã môn học</th>
                                    <th  style="display: table-caption;">Tên lớp</th>
                                 <!--    <th >Số lượng SV</th>  -->
                                    <th  style="width: 150px">Học kỳ</th>
                                       <th  style="width: 150px;">Năm học</th>
                                    <th style="width: 150px">Ngày lập</th>
                                     <!-- <th style="width: 150px">Ngày cập nhật</th> -->
<!--                                      <?php if(isset($_SESSION['DPYCTB'])) {?>
                                    <th >Ngày duyệt phiếu || Ngày hủy phiếu</th>
                                    <?php } ?> -->
                                    <th style="width: 150px">Trạng thái</th>
                                    <th scope="colo"></th>
                                    
                                </tr>
                            
                            </thead>
                            <tbody>
                              <?php 
                                      $query="SELECT *,hd.TrangThai FROM tblhoadon hd, tbltaikhoan tk ,tblhocky hk,namhoc nh
                                        WHERE hd.MaTK=tk.MaTK AND hk.MaHK=hd.HocKy AND nh.id=hd.NamHoc  AND hd.MaKhoa=".$_SESSION['MaKhoa']."
                                        AND hd.TrangThai=6 
                                        ORDER BY NgayLapPhieu DESC ";
                                        $result = mysqli_query($connect, $query);
                                    
                                $a=0;
                                 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                 { 
                                    $datelap = date('d-m-Y', strtotime($row['NgayLapPhieu'] ));
                                    $timelap = date('H:i:s', strtotime($row['NgayLapPhieu']));

                                    $datecn = date('d-m-Y', strtotime($row['NgayCapNhat'] ));
                                    $timecn = date('H:i:s', strtotime($row['NgayCapNhat']));

                                    $dateduyet = date('d-m-Y', strtotime($row['NgayDuyetPhieu'] ));
                                    $timeduyet = date('H:i:s', strtotime($row['NgayDuyetPhieu']));
                                $i++;  
                                ?>
                                <td style="width: 10px"><?php echo $i ?></td>
                                <td style="width: 250px"><?php echo $row['TenDangNhap']; ?></td> 
                                <td class="overflow" style="word-wrap:break-word;width: 217px;display: table-caption;border-bottom: 1px solid;"><?php  echo $row['MonHoc']  ?></td>
                                <td class="overflow" style="word-wrap:break-word;width: 217px;display: table-caption;"><?php echo $row['NhomLop']  ?></td>
                               <!--  <td><?php echo $row['SLSV']  ?></td> -->
                                <td style="width: 150px"><?php echo $row['TenHK']  ?></td>
                                        <td style="width: 150px"><?php echo $row['NamHoc']  ?></td>
                                <td  style="width: 160px"><?php echo $datelap .'  '. $timelap ?></td>

                               <!--  <td style="width: 110px"><?php  if($row['NgayCapNhat']){echo $datecn .'<br>'. $timecn; } ?></td> -->
                                <!-- <?php if(isset($_SESSION['DPYCTB'])) { ?>
                                  <td style="width: 110px"><?php if($row['NgayDuyetPhieu']){echo $dateduyet .'<br>'. $timeduyet; } ?></td>
                                  <?php } ?> -->
                             
                                <?php  if($row['TrangThai']==6) {?>
                                <td><span style="width: 106px;" class="badge badge-pill badge-dark">Chờ tổng hợp</span></td>
                                <?php } ?>

                            <td>
                                <a class="ti-eye"href="chitiet-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $row['MaHD'] ?>"></a>
                            </td>
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
