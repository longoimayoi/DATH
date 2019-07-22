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
                        <strong class="card-title">LỊCH SỬ LẬP PHIẾU</strong>
                      </div>
                   <!--   <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">hiển thị</button> -->
                    <div class="card-body" >
                        <table  id="bootstrap-data-table-export"  class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th style="width: 150px">Người lập phiếu</th>
                                    <th  style="display: table-caption;width: 133px;height:50px">Mã môn học</th>
                                    <th  style="display: table-caption;height:50px">Tên lớp</th>
                                 <!--    <th >Số lượng SV</th>  -->
                                    <th >Học kỳ</th>
                                    <th  style="width: 150px;">Năm học</th>
                                    <th >Ngày lập</th>
                                    <!--  <th >Ngày cập nhật</th> -->
                                     <th style="width: 250px" >Ngày duyệt phiếu </th>
                                    <th style="width: 80px">Trạng thái</th>
                                    <th scope="colo"></th>
                                    
                                </tr>
                            
                            </thead>

                            <tbody>
                              <?php 
                              $YCTBVT=0;
                                  $DP_LDDV=0;
                                   $status = array();
                                    
                                    if (isset($_SESSION['DP_NVPQT']))
                                    {
                                      array_push($status, 10);
                                    }
                                    if (isset($_SESSION['QLK']))
                                    {
                                      array_push($status, 6);
                                      array_push($status, 9);
                                    }
                                     if (isset($_SESSION['YCTBVT']))
                                    {
                                      $YCTBVT=1;
                                      array_push($status, 5);
                                      array_push($status, 7);
                                      array_push($status, 3);
                                    }
                                    $strStatus = implode(",", $status);
                                    if($YCTBVT==1)
                                    {
                                    $query="SELECT *,hd.TrangThai FROM tblhoadon hd, tbltaikhoan tk ,tblhocky hk,namhoc nh
                                    WHERE hd.MaTK=tk.MaTK AND hk.MaHK=hd.HocKy AND nh.id=hd.NamHoc 
                                     AND tk.MaTK=".$_SESSION['uid']."
                                    ORDER BY NgayLapPhieu DESC ";
                                }else{
                                     $query="SELECT *,hd.TrangThai FROM tblhoadon hd, tbltaikhoan tk ,tblhocky hk,namhoc nh
                                    WHERE hd.MaTK=tk.MaTK AND hk.MaHK=hd.HocKy AND nh.id=hd.NamHoc 
                                    AND tk.MaTK=".$_SESSION['uid']."
                                    ORDER BY NgayLapPhieu DESC ";
                                }
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
                                   <td style="width: 150px"><?php echo $row['NamHoc']  ?></td>
                                <td  style="width: 110px"><?php echo $datelap .'<br>'. $timelap ?></td>

                                <!-- <td style="width: 110px"><?php  if($row['NgayCapNhat']){echo $datecn .'<br>'. $timecn; } ?></td> -->
                                  <td style="width: 110px"><?php if(isset($row['NgayDuyetPhieu'])){echo $dateduyet .'<br>'. $timeduyet; }?></td>
                                <?php 
                               if($row['TrangThai']==0) { ?>
                                    <td  style="text-align: center;"><span style="background-color: #ba60c9;width: auto;height: auto" class="badge badge-pill badge-primary">Chờ báo giá </span></td>
                                  <?php } if($row['TrangThai']==1) { ?>
                                    <td style="text-align: center;"><span style="background-color: #cd9513;width: auto;height: auto"class="badge badge-pill badge-warning">Chờ lãnh đạo phòng<br> quản trị duyệt</span></td>
                                  <?php } if($row['TrangThai']==2) { ?>
                                    <td style="text-align: center;"><span  style="width: auto;height: auto" class="badge badge-pill badge-warning">Chờ ban giám <br> hiệu duyệt</span></td>
                                  <?php } if($row['TrangThai']==3) {?>
                                    <td style="text-align: center;"><span  style="width: auto;height: auto" class="badge badge-pill badge-success">Đã duyệt</span></td>
                                  <?php } if($row['TrangThai']==5) {?>
                                    <td style="text-align: center;"><span style="background-color: #7ec960;width: auto;height: auto" class="badge badge-pill badge-info">Chờ thêm vật tư</span></td>
                                  <?php } if($row['TrangThai']==6) {?>
                                    <td style="text-align: center;"><span style="background-color: #b0afab;width: auto;height: auto"class="badge badge-pill badge-dark">Chờ nhân viên<br> quản lý kho duyệt</span></td>
                                  <?php } if($row['TrangThai']==7 || $row['TrangThai']==9) {?>
                                    <td style="text-align: center;"><span style="width: auto;height: auto" class="badge badge-pill badge-danger">Không duyệt phiếu</span></td>
                                  <?php } if($row['TrangThai']==8) {?>
                                    <td style="text-align: center;"><span style="width: auto;height: auto;background-color: #98979669" class="badge badge-pill badge-dark">Chờ lãnh đạo<br> đơn vị duyệt</span></td>
                                    
                                  <?php } if($row['TrangThai']==10) {?>
                                    <td style="text-align: center;"><span style="background-color: #b7ab8a;width: auto;height: auto" class="badge badge-pill badge-dark">Chờ tổng hợp </span></td>
                                  <?php } if($row['TrangThai']==11) {?>

                                  <td style="text-align: center;"><span style="background-color: #6ecf72; width: auto;height: auto" class="badge badge-pill badge-dark">Đã tổng hợp </span></td>
                                
                                <?php } if($row['TrangThai']==12) {?>

                                  <td style="text-align: center;"><span style="background-color: #debfe8; width: auto;height: auto" class="badge badge-pill badge-dark">Đã nhập kho</span></td>
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
