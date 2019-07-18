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

if(isset($_POST['submit']))
{
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $today=date("Y-m-d H:i:s");
  $MaTK=$_SESSION['uid'];

    // $TenPhieu = $_POST["TenPhieu"];
  $MonHoc = $_POST["MonHoc"];
  $NhomLop = $_POST["NhomLop"];
  $SLSV = $_POST["SLSV"];
  $NamHoc=$_POST['NamHoc'];
  $HocKy = $_POST["HocKy"];
  $khoa=$_SESSION['MaKhoa'];
  $GhiChu=$_POST['GhiChu'];
  $sql1 = "INSERT INTO tblhoadon(MaTK,MaKhoa,MonHoc,NhomLop,SLSV,NamHoc,HocKy,NgayLapPhieu,TrangThai,GhiChu)
  VALUES('$MaTK','$khoa','$MonHoc','$NhomLop','$SLSV','$NamHoc','$HocKy','$today',5,'$GhiChu')";
  $query = mysqli_query($connect,$sql1);
  if(mysqli_affected_rows($connect)==1)
  {
    $MaHD=mysqli_insert_id($connect);
    echo "<script>alert('Lập phiếu thành công')</script>";
    echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=$MaHD';</script>");
  }
  else
  {
    echo "<script>alert('Lập phiếu không thành công')</script>";
  }
         //echo("<script>location.href = '"."danh-sach-tai-khoan.php';</script>");
}

?>
<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">DANH SÁCH PHIẾU ĐỀ XUẤT</strong>
            <?php if(isset($_SESSION['YCTBVT'])) { ?>
              <button style="float: right;" type="submit" data-toggle="modal" data-target="#myModala">

                <span class="fa fa-plus" aria-hidden="true"></span> Thêm phiếu đề xuất</a>
              </button>
            <?php } ?>

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
                 <!--  <th  style="width: 150px;">Học kỳ</th> -->
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
                                  $YCTBVT=0;
                                  $DP_LDDV=0;
                                  $status = array();
                                  if (isset($_SESSION['BG']))
                                  {
                                    array_push($status, 0);
                                  }
                                   if (isset($_SESSION['DP_LDPQT']))
                                  {
                                    array_push($status, 1);
                                  }
                                    if (isset($_SESSION['DP_BGH']))
                                  {
                                    array_push($status, 2);
                                    array_push($status, 3);
                                  }
                                  if (isset($_SESSION['DP_NVPQT']))
                                  {
                                    array_push($status, 10);
                                  }
                                 
                                  if (isset($_SESSION['DP_LDDV']))
                                  {
                                    $DP_LDDV=1;
                                    array_push($status, 8);
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
                                    AND hd.TrangThai in ($strStatus) AND tk.MaTK=".$_SESSION['uid']."
                                    ORDER BY NgayLapPhieu DESC ";
                                  }if($DP_LDDV==1)
                                  {
                                   $query="SELECT *,hd.TrangThai FROM tblhoadon hd, tbltaikhoan tk ,tblhocky hk,namhoc nh
                                   WHERE hd.MaTK=tk.MaTK AND hd.HocKy=hk.MaHK AND hd.NamHoc= nh.id
                                   AND hd.TrangThai in ($strStatus) AND hd.MaKhoa=".$_SESSION['MaKhoa']."
                                   ORDER BY NgayLapPhieu DESC ";
                                 }else{
                                   $query="SELECT *,hd.TrangThai FROM tblhoadon hd, tbltaikhoan tk,namhoc nh WHERE hd.TrangThai in ($strStatus) and hd.MaTK = tk.MaTK and hd.NamHoc = nh.id
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
                                  $i++;  
                                  ?>
                                  <td style="width: 10px"><?php echo $i ?></td>
                                  <td style="width: 250px"><?php echo $row['TenDangNhap']; ?></td> 
                                  <td class="overflow" style="word-wrap:break-word;width: 217px;display: table-caption;border-bottom: 1px solid;"><?php  echo $row['MonHoc']  ?></td>
                                  <td class="overflow" style="word-wrap:break-word;width: 217px;display: table-caption;"><?php echo $row['NhomLop']  ?></td>
                                  <!--  <td><?php echo $row['SLSV']  ?></td> -->
                                 <!--  <td style="width: 150px"><?php echo $row['TenHK']  ?></td> -->
                                  <td style="width: 150px"><?php echo $row['NamHoc']  ?></td>
                                  <td  style="width: 160px"><?php echo $datelap .'  '. $timelap ?></td>

                                  <!--  <td style="width: 110px"><?php  if($row['NgayCapNhat']){echo $datecn .'<br>'. $timecn; } ?></td> -->
                                <!-- <?php if(isset($_SESSION['DPYCTB'])) { ?>
                                  <td style="width: 110px"><?php if($row['NgayDuyetPhieu']){echo $dateduyet .'<br>'. $timeduyet; } ?></td>
                                  <?php } ?> -->
                                  <?php 
                                  if($row['TrangThai']==0) { ?>
                                    <td style="text-align: center;"><span    style="background-color: #ba60c9;width: auto;height: auto"class="badge badge-pill badge-primary">Chờ báo giá </span></td>
                                  <?php } if($row['TrangThai']==1) { ?>
                                    <td style="text-align: center;"><span    style="background-color: #cd9513;width: auto;height: auto"class="badge badge-pill badge-warning">Chờ lãnh đạo phòng  <br>quản trị duyệt</span></td>
                                  <?php } if($row['TrangThai']==2) { ?>
                                    <td style="text-align: center;"><span    style="width: auto;height: auto"class="badge badge-pill badge-warning">Chờ ban giám<br> hiệu duyệt</span></td>
                                  <?php } if($row['TrangThai']==3) {?>
                                    <td style="text-align: center;"><span    style="width: auto;height: auto"class="badge badge-pill badge-success">Đã duyệt</span></td>
                                  <?php } if($row['TrangThai']==5) {?>
                                    <td style="text-align: center;"><span   style="background-color: #7ec960;width: auto;height: auto" class="badge badge-pill badge-info">Chờ thêm vật tư</span></td>
                                  <?php } if($row['TrangThai']==6) {?>
                                    <td style="text-align: center;"><span   style="background-color: #b0afab;width: auto;height: auto" class="badge badge-pill badge-warning">Chờ nhân viên<br> quản lý kho duyệt</span></td>
                                  <?php } if($row['TrangThai']==7 || $row['TrangThai']==9) {?>
                                    <td style="text-align: center;"><span  style="width: auto;height: auto"class="badge badge-pill badge-danger">Không duyệt phiếu</span></td>
                                  <?php } if($row['TrangThai']==8) {?>
                                    <td style="text-align: center;"><span  style="width: auto;height: auto;background-color: #98979669" class="badge badge-pill badge-dark">Chờ lãnh đạo<br> đơn vị duyệt</span></td>
                                    
                                  <?php } if($row['TrangThai']==10) {?>
                                    <td style="text-align: center;"><span   style="background-color: #b7ab8a;width: auto;height: auto" class="badge badge-pill badge-dark">Chờ tổng hợp </span></td>
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
              <div class="modal fade" id="myModala" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content" style="width: 600px;">
                    <div class="modal-body modal-body-sub_agile">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <div class="card-body card-block">
                      <h3 class="agileinfo_sign" align="center">PHIẾU YÊU CẦU TRANG BỊ</h3>

                      <p style="width: 50px;"></p>
                      <form action="" method="post"  >

                       <!--  <div class=" form-group">
                            <input type="text" placeholder="Nhập tên đề xuất" name="TenPhieu" required="" class="form-control">
                        
                          </div> -->
                          <div class=" form-group">
                            <!-- <select class="form-control" name="khoa" id="">
                              <option  value="1" >Chọn khoa</option> -->
                              <?php 
                              $query="SELECT TenKhoa FROM tblkhoa WHERE MaKhoa =".$_SESSION["MaKhoa"];
                              $result=mysqli_query($connect,$query);
                              $row = mysqli_fetch_array($result);

                              ?>
                              <!-- </select> -->
                              <input type="text" name ="khoa" disabled value ="<?php echo $row[0] ?>" class="form-control" required>
                            </div>
                            <div class="form-group" style="display: flex;">
                             <select class="form-control" name="NamHoc" id="" >
                              <?php $query="SELECT * FROM namhoc ORDER BY id DESC LIMIT 0, 1";
                              $result=mysqli_query($connect,$query);
                              while ($item=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                ?>
                                <option  value="<?php echo $item['id'] ?>"><?php echo $item['NamHoc'] ?></option>
                                <?php
                              }
                              ?>
                            </select>
                            <select class="form-control" name="HocKy" id="">
                              <option   disabled="">Chọn học kỳ</option>
                              <?php $query="SELECT * FROM tblhocky";
                              $result=mysqli_query($connect,$query);
                              while ($item=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                ?>
                                <option  value="<?php echo $item['MaHK'] ?>"><?php echo $item['TenHK'] ?></option>
                                <?php
                              }
                              ?>
                            </select>

                          </div>
                          <div class=" form-group">
                           <select class="form-control" name="MonHoc" id="">
                            <option   disabled="">--Chọn môn học--</option>
                            <?php $query="SELECT * FROM monhoc";
                            $result=mysqli_query($connect,$query);
                            while ($item=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                              ?>
                              <option  value="<?php echo $item['MaMon'] ?>"><?php echo $item['TenMon'] ?></option>
                              <?php
                            }
                            ?>
                          </select>

                        </div>

                        <div class=" form-group">
                          <input type="text" placeholder="Nhập tên lớp" name="NhomLop" class="form-control" required>
                        </div>
                        <div class=" form-group">
                          <input type="text" placeholder="Nhập số lượng sinh viên" name="SLSV" class="form-control" required>
                        </div>

                        <div class=" form-group">
                          <input type="text" placeholder="Nhập lý do" name="GhiChu" class="form-control">
                        </div>
                        <button style="background-color: #217346;float:right;"type="submit" name="submit">Thêm</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php include 'scriptindex.php'; ?>
          </body>
          </html>
