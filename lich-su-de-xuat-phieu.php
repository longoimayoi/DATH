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
                        <strong class="card-title"><?php if(isset($_SESSION['YCTBVT']) && isset($_SESSION['DPYCTB'])) { echo "DANH SÁCH THEO DÕI & LỊCH SỬ DUYỆT PHIẾU"; }elseif(isset($_SESSION['YCTBVT'])) { echo "DANH SÁCH THEO DÕI PHIẾU ĐỀ XUẤT"; } elseif(isset($_SESSION['DPYCTB'])) { echo "DANH SÁCH LỊCH SỬ DUYỆT PHIẾU";  } ?></strong>

                    </div>
                   <!--   <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">hiển thị</button> -->
                    <div class="card-body" >
                        <table  id="bootstrap-data-table-export"  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th style="width: 150px">Người lập phiếu</th>
                                    <th  style="display: table-caption;width: 133px;height: 30px">Mã môn học</th>
                                    <th  style="display: table-caption;">Tên lớp</th>
                                 <!--    <th >Số lượng SV</th>  -->
                                    <th >Học kỳ</th>
                                    <th >Ngày lập</th>
                                    <!--  <th >Ngày cập nhật</th> -->
                                     <th style="width: 250px" >Ngày duyệt phiếu <hr> Ngày hủy phiếu</th>
                                    <th style="width: 80px">Trạng thái</th>
                                    <th scope="colo"></th>
                                    
                                </tr>
                            
                            </thead>

                            <tbody>
                              <?php 
                            if(isset($_SESSION['YCTBVT']) && isset($_SESSION['DPYCTB'])) {
                                 $query="SELECT *,hd.TrangThai FROM tblhoadon hd, tbltaikhoan tk ,tblhocky hk
                                        WHERE hd.MaTK=tk.MaTK AND hk.MaHK=hd.HocKy 


                                        ORDER BY NgayLapPhieu DESC ";
                                $result = mysqli_query($connect, $query);
                            }elseif(isset($_SESSION['YCTBVT'])) {
                                 $query="SELECT *,hd.TrangThai FROM tblhoadon hd, tbltaikhoan tk ,tblhocky hk
                                        WHERE hd.MaTK=tk.MaTK AND hk.MaHK=hd.HocKy 
                                        AND hd.TrangThai!=5
                                        AND tk.MaTK=".$_SESSION['uid']."
                                        ORDER BY NgayLapPhieu DESC ";
                                $result = mysqli_query($connect, $query);
                            }elseif(isset($_SESSION['DPYCTB'])) {
                                 $query="SELECT *,hd.TrangThai FROM tblhoadon hd, tbltaikhoan tk ,tblhocky hk
                                        WHERE hd.MaTK=tk.MaTK AND hk.MaHK=hd.HocKy 
                                        AND hd.TrangThai!=5   AND hd.TrangThai!=0 AND hd.TrangThai!=1

                                        ORDER BY NgayLapPhieu DESC ";
                                $result = mysqli_query($connect, $query);
                            }
                                $a=0;
                                 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                 { 
                                    $datelap = date('d-m-Y', strtotime($row['NgayLapPhieu'] ));
                                    $timelap = date('H:i:s', strtotime($row['NgayLapPhieu']));

                                    $datecn = date('d-m-Y', strtotime($row['NgayCapNhat'] ));
                                    $timecn = date('H:i:s', strtotime($row['NgayCapNhat']));

                                    $dateduyet = date('d-m-Y', strtotime($row['NgayDuyetPhieu'] ));
                                    $timeduyet = date('H:i:s', strtotime($row['NgayDuyetPhieu']));


                                    $datehuy = date('d-m-Y', strtotime($row['NgayHuyPhieu'] ));
                                    $timehuy = date('H:i:s', strtotime($row['NgayHuyPhieu']));
                                $i++;  
                                ?>
                                <td ><?php echo $i ?></td>
                                <td><?php echo $row['TenDangNhap']; ?></td> 
                                <td class="overflow" style="word-wrap:break-word;width: 150px;display: table-caption;border-bottom: 1px solid;"><?php  echo $row['MonHoc']  ?></td>
                                <td class="overflow" style="word-wrap:break-word;width: 150px;display: table-caption;"><?php echo $row['NhomLop']  ?></td>
                               <!--  <td><?php echo $row['SLSV']  ?></td> -->
                                <td style="width: 150px "><?php echo $row['TenHK']  ?></td>
                                <td  style="width: 110px"><?php echo $datelap .'<br>'. $timelap ?></td>

                                <!-- <td style="width: 110px"><?php  if($row['NgayCapNhat']){echo $datecn .'<br>'. $timecn; } ?></td> -->
                                  <td style="width: 110px"><?php if(isset($row['NgayDuyetPhieu'])){echo $dateduyet .'<br>'. $timeduyet; } elseif(isset($row['NgayHuyPhieu'])) {echo $datehuy .'<br>'. $timehuy; }?></td>
                                <?php 
                                if($row['TrangThai']==0) { ?>
                                <td><span class="badge badge-pill badge-primary">Chờ báo giá </span></td>
                                <?php } if($row['TrangThai']==1) { ?>
                                <td><span class="badge badge-pill badge-warning">Chờ duyệt</span></td>
                                <?php } if($row['TrangThai']==2) {?>
                                <td><span class="badge badge-pill badge-success">Đã duyệt</span></td>
                                <?php } if($row['TrangThai']==4) {?>
                                <td><span style="width: 118px;" class="badge badge-pill badge-danger">Không được duyệt</span></td>
                                <?php } if($row['TrangThai']==5) {?>
                                <td><span style="width: 106px;" class="badge badge-pill badge-info">Chờ thêm vật tư</span></td>
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
