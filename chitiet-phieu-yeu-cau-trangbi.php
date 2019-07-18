<style>
  .hidden{
    display: none;
  }
  .overflow{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    
  }
  .overflow:hover { 
    overflow: visible;
    white-space: pre-line;

  }
</style>
<?php include 'header.php';
include('connect/myconnect.php');
include 'leftpanel.php' ;
$MaHD=$_GET['MaHD'];
$i=1;
date_default_timezone_set('Asia/Ho_Chi_Minh');
$ngaycn=date("Y-m-d H:i:s");
$query_c="SELECT COUNT(DonGia) as SL FROM  tblphieuyeucautrangbi WHERE MaHD=$MaHD AND DonGia =0";
$result_c=mysqli_query($connect,$query_c);
list($SL)=mysqli_fetch_array($result_c,MYSQLI_NUM);

$query_d="SELECT COUNT(HocPhiCoBan) as HPCB FROM  tblhoadon WHERE MaHD=$MaHD ";
$result_d=mysqli_query($connect,$query_d);
list($HPCB)=mysqli_fetch_array($result_d,MYSQLI_NUM);

if(isset($_POST['submit']))
{
  $mavt=$_POST['mavt'];
  $tenvt=$_POST['tenvt'];
  $sl=$_POST['sl'];
  $dvtinh=$_POST['dvtinh'];
  $thongso=$_POST['thongso'];
  $xuatxu=$_POST['xuatxu'];
  $ghichu=$_POST['ghichu'];
  $goiydg=$_POST['goiydg'];
  $dongia=0;
  if($sl < 0)
  {
    echo "<script>alert('Số lượng phải lớn hơn 0')</script>";
  }
  else if(is_numeric($dvtinh))
  {
    echo "<script>alert('Đơn vị tính phải là kiểu chuỗi')</script>";
  }
  else
  {

    foreach ($mavt as $k => $v)
    {
      $query="INSERT INTO tblphieuyeucautrangbi(MaHD,MaVatTu,TenVatTu,DVT,SL,GoiYDG,ThongSoKT,XuatXu,GhiChu,DonGia) VALUES
      ($MaHD,'$v','$tenvt[$k]','$dvtinh[$k]','$sl[$k]','$goiydg[$k]','$thongso[$k]','$xuatxu[$k]','$ghichu[$k]',0)";
      $result=mysqli_query($connect,$query)or die("Query {$query} \n <br> MySql erros:".mysqli_errno($connect));
    }
    if(mysqli_affected_rows($connect)==1)
    {

      if($SL > 0)
      {
        $query_up="UPDATE tblhoadon set NgayCapNhat='$ngaycn' WHERE MaHD='$MaHD'";
        $result_up=mysqli_query($connect,$query_up);
        echo "<script>alert('Thêm chi tiết thành công')</script>";
        echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=$MaHD';</script>");
      }
      else
      {
        echo "<script>alert('Thêm chi tiết thành công')</script>";
        echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=$MaHD';</script>");
      }

    }
    else
    {
      echo "<script>alert('Lập phiếu không thành công')</script>";
    }


  }
}
if(isset($_POST['import']))
{
  $data=array();
  if($_FILES['file']['tmp_name'])
  {
    $dom = DOMDocument::load($_FILES['file']['tmp_name']);
    $rows = $dom->getElementsByTagName('Row');
    $first_row = true;
    foreach ($rows as $row)
    {
      if(!$first_row)
      {
        $index = 2;
        $cells = $row->getElementsByTagName('Cell');
        foreach ($cells as $cell)
        {
          $ind = $cell->getAttribute('Index');
          if($ind != null) $index = $ind;
          if($index == 2)
            $mavattu = $cell->nodeValue;
          if($index == 3)
            $tenvattu = $cell->nodeValue;
          if($index == 4)
            $dvt = $cell->nodeValue;
          if($index == 5)
            $sl = $cell->nodeValue;
          if($index == 6)
            $thongso = $cell->nodeValue;
          if($index == 7)
            $xuatxu = $cell->nodeValue;
          if($index == 8)
            $ghichu = $cell->nodeValue;
          
          $index++;
        }
        $data[]=array(
          'MaVatTu' =>$mavattu,
          'TenVatTu' =>$tenvattu,
          'DVT'  =>$dvt,
          'SL'  =>$sl,
          'ThongSoKT'  =>$thongso,
          'XuatXu'  =>$xuatxu,
          'GhiChu'  =>$ghichu
        );
      }
      $first_row = false;
    }
  }
  if($data)
  {
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    $dem_tt=1;
    foreach ($data as $row)
    {
      if($dem_tt>1)
      {
        $dongia=0;
        $matk=$_SESSION['uid'];
        $a1=$row['MaVatTu'];
        $a2=$row['TenVatTu'];
        $a3=$row['DVT'];
        $a4=$row['SL'];
        $a5=$row['ThongSoKT'];
        $a6=$row['XuatXu'];
        $a7=$row['GhiChu'];
        $query="INSERT INTO tblphieuyeucautrangbi(MaHD,MaVatTu,TenVatTu,DVT,SL,DonGia,ThongSoKT,XuatXu,GhiChu)
        VALUES($MaHD,'{$a1}','{$a2}','{$a3}',$a4,$dongia,'$a5','$a6','$a7')";
        $results=mysqli_query($connect,$query);
      }
      $dem_tt++;
    }
    if($SL > 0)
    {
      $query_up="UPDATE tblhoadon set NgayCapNhat='$ngaycn' WHERE MaHD='$MaHD'";
      $result_up=mysqli_query($connect,$query_up);
      echo("<script>location.href = '"."show-table-phieu-import.php?MaHD=$MaHD';</script>");
    }
    else
    {
      echo("<script>location.href = '"."show-table-phieu-import.php?MaHD=$MaHD';</script>");
    }

  }
}
$query1="SELECT TongTien,MonHoc,NhomLop,SLSV,MaKhoa,NamHoc,HocKy,TrangThai,GhiChu,HocPhiCoBan, LyDoHuy FROM tblhoadon WHERE MaHD='$MaHD' ";
$result1=mysqli_query($connect,$query1);
list($TongTien,$MonHoc,$NhomLop,$SLSV,$Khoa,$NamHoc,$HocKy,$TrangThai,$GhiChu,$HocPhiCoBan,$LyDoHuy)=mysqli_fetch_array($result1,MYSQLI_NUM);
if(isset($_POST['edit']))
{

  /*$TDX1=$_POST['TDX'];*/
  $MonHoc1=$_POST['MonHoc'];
  $NhomLop1=$_POST['NhomLop'];
  $SLSV1=$_POST['SLSV'];
  $khoa1=$_POST['khoa'];
  $HocKy1=$_POST['HocKy'];
  $GhiChu1=$_POST['GhiChu'];
  $query_tt="UPDATE tblhoadon SET MonHoc='$MonHoc1',NhomLop='$NhomLop1',SLSV='$SLSV1',HocKy='$HocKy1',NgayCapNhat='$ngaycn', GhiChu='$GhiChu1'WHERE MaHD=$MaHD";
  $result_tt=mysqli_query($connect,$query_tt);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Sửa thông tin phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=$MaHD';</script>");

  }
  else
  {
    echo "<script>alert('Sửa thông tin phiếu đề xuất không thành công')</script>";
  }
}
if(isset($_POST['huy']))
{
  include('huy-phieu-yeu-cau-trangbi.php');
}
if(isset($_POST['guiphieu']))
{
  $query_g="UPDATE tblhoadon set TrangThai=6 WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Gửi phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");

  }

}
if(isset($_POST['luuhocphi']))
{
  $hocphi=$_POST['hocphi'];
  $query_hp="UPDATE tblhoadon set HocPhiCoBan='$hocphi' WHERE MaHD='$MaHD'";
  $result_hp=mysqli_query($connect,$query_hp);
  if(mysqli_affected_rows($connect)==1)
  {
   // echo  "<script type='text/javascript'>alert('Lưu  thành công');</script>";
     echo("<script>location.href = '"."chitiet-phieu-yeu-cau-trangbi.php?MaHD=$MaHD';</script>");

  }

}

if(isset($_POST['qlkduyet']))
{
   $query_g="UPDATE tblhoadon set TrangThai=8,idNhanVienKho=".$_SESSION['uid'].",NgayNVKDuyet='$ngaycn' WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Duyệt phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");

  }
}
if(isset($_POST['qlkhuy']))
{
   $query_g="UPDATE tblhoadon set TrangThai=7,NgayHuyPhieu='$ngaycn' WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Không duyệt phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");

  }
}
if(isset($_POST['qldvduyet']))
{
   $query_g="UPDATE tblhoadon set TrangThai=10,idLDDV=".$_SESSION['uid'].",NgayLDDVDuyet='$ngaycn' WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Duyệt phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");

  }
}
if(isset($_POST['qldvhuy']))
{
   $query_g="UPDATE tblhoadon set TrangThai=9,NgayHuyPhieu='$ngaycn' WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Không duyệt phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");

  }
}
if(isset($_POST['ldpqtduyet']))
{
   $query_g="UPDATE tblhoadon set TrangThai=2,idLDPQT=".$_SESSION['uid'].",NgayLDPQTDuyet='$ngaycn' WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Duyệt phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");

  }
}
if(isset($_POST['hpduyet']))
{
   $query_g="UPDATE tblhoadon set TrangThai=3,NgayDuyetPhieu='$ngaycn' WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Duyệt phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");

  }
}
if(isset($_POST['hphuy']))
{
   $query_g="UPDATE tblhoadon set TrangThai=4,NgayHuyPhieu='$ngaycn' WHERE MaHD='$MaHD'";
  $result_g=mysqli_query($connect,$query_g);
  if(mysqli_affected_rows($connect)==1)
  {
    echo  "<script type='text/javascript'>alert('Không duyệt phiếu đề xuất thành công');</script>";
    echo("<script>location.href = '"."danhsach-phieu-yeu-cau-trangbi.php';</script>");

  }
}
?>

<!-- <div class="row">
  <div class="col-lg-12">
    <button style="margin-left: 36px;background: transparent;width:40px;color: red; border: 1.65px solid;"type="reset"
    onclick="window.location.href='danhsach-phieu-yeu-cau-trangbi.php'"><span style="margin-left: -8px"class="ti-arrow-left"></span></button>
  </div>
</div> -->
<!-- <div class="container"> -->
  <div class="content mt-3">
    <div class="col-lg-12" >
      <div class="card">
        <div class="card-header">
          <strong>CHI TIẾT PHIẾU ĐỀ XUẤT</strong>
        </div>
        <div class="card-body card-block">
          <form action="" method="post">
            <div class="row form-group" id="checkopenedit">
            <!-- <div class="col-lg-6">
              <label for="">Tên đề xuất</label>
              <input class="form-control edit" type="text" name="TDX" value="<?php echo $TDX; ?>" disabled="">
            </div> -->
            <div class="form-group  col-lg-6">
          <label for="">Đơn vị yêu cầu</label>
          <select class="form-control " name="khoa" id="" disabled="">
            <?php $query="SELECT * FROM tblkhoa";
            $result=mysqli_query($connect,$query);
            while ($item1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              ?>
              <option
              <?php if($Khoa==$item1['MaKhoa'])
              echo 'selected="selected"';
              ?>
              value="<?php echo $item1['MaKhoa'] ?>"><?php echo $item1['TenKhoa'] ?></option>
              <?php
            }
            ?>
          </select>
        </div>
            <div class="form-group col-lg-6">
                <label for="">Mã môn học</label>
              <label for="" style="margin-left: 180px;">Hệ số K</label>
              <div style="display: flex;">
                <?php if (count(explode(',', $MonHoc)) > 1){ ?>
                  <input class="form-control  overflow" type="text" name="MonHoc" value="<?php echo $MonHoc; ?>" disabled="">
                <?php } else { ?>
                  <select class="form-control edit" name="MonHoc" id="" disabled="">
                   <?php $queryK="SELECT * FROM monhoc";
                   $resultK=mysqli_query($connect,$queryK);
                   while ($item=mysqli_fetch_array($resultK,MYSQLI_ASSOC)) {
                    ?>
                    <option
                    <?php if($MonHoc==$item['MaMon'])
                    echo 'selected="selected"';
                    ?>
                    value="<?php echo $item['MaMon'] ?>"><?php echo $item['MaMon'] ?> - <?php echo $item['TenMon'] ?></option>
                    <?php
                  }
                  ?>
                </select>
              <?php } ?>
              <?php 
              $sqlK = "SELECT HeSoK FROM monhoc WHERE MaMon='$MonHoc'";
              $queryK = mysqli_query($connect, $sqlK);
              $rowK = mysqli_fetch_assoc($queryK);
              ?>
              <input class="form-control  overflow" type="text" name="HeSoK" value="<?php echo $rowK['HeSoK']; ?>" disabled="">
            </div>
      </div>
        <div class="form-group  col-lg-6">
          <label for="">Tên lớp</label>
           <label for="" style="margin-left: 210px;">Số lượng sinh viên</label>
            <div style="display: flex;">
          <input class="form-control edit overflow" type="text" name="NhomLop" value="<?php echo $NhomLop; ?>" disabled="">
          <input class="form-control edit" type="text" name="SLSV" value="<?php echo $SLSV; ?>" disabled="">
           </div>
        </div>
        
        <div class="form-group  col-lg-6" >
          <label for="">Năm học</label>
           <label for="" style="margin-left: 200px;">Học kỳ</label>
          <div style="display: flex;">
           <select class="form-control edit" name="NamHoc" id="" disabled="">
            <?php $query="SELECT * FROM namhoc ORDER BY id DESC LIMIT 0,1";
            $result=mysqli_query($connect,$query);
            while ($item1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              ?>
              <option
              <?php if($NamHoc==$item1['id'])
              echo 'selected="selected"';
              ?>
              value="<?php echo $item1['id'] ?>"><?php echo $item1['NamHoc'] ?></option>
              <?php
            }
            ?>
          </select>
          <select class="form-control edit" name="HocKy" id="" disabled="">
            <?php $query="SELECT * FROM tblhocky";
            $result=mysqli_query($connect,$query);
            while ($item1=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
              ?>
              <option
              <?php if($HocKy==$item1['MaHK'])
              echo 'selected="selected"';
              ?>
              value="<?php echo $item1['MaHK'] ?>"><?php echo $item1['TenHK'] ?></option>
              <?php
            }
            ?>
          </select>
          
          </div>
        </div>
         <div class="form-group  col-lg-6">
          <label for="">Lý do</label>
          <input class="form-control edit overflow" type="text" name="GhiChu" value="<?php echo $GhiChu; ?>" disabled="">
        </div>


        <?php if($TrangThai==2 || $TrangThai==4 || $TrangThai ==1)   {?>
         <div class="form-group  col-lg-6">
          <label for="">Tổng tiền</label>
          <input class="form-control  overflow" type="text"  value="<?php echo number_format($TongTien); ?> VNĐ" disabled="">
        </div>
        <div class="form-group  col-lg-6">
          <label for="">Chi phí/sinh viên</label>
          <input class="form-control  overflow" type="text"  value="<?php $ChiPhi = $TongTien/$SLSV ; echo $ChiPhi; ?> VNĐ" disabled="">
        </div>
      <?php }  ?>
      <?php if( $TrangThai==4 ){?>
         <div class="form-group  col-lg-6">
          <label for="">Lý do không duyệt</label>
          <input class="form-control  overflow" type="text"  value="<?php echo $LyDoHuy ?>" disabled="">
        </div>
        
      <?php }  ?>
      <div class="form-group  col-lg-6 edit">
        <label for="">Trạng thái</label>
        <br>

        <?php
        if($TrangThai==0){?>
          <span style="background-color: #ba60c9;width: auto;height: auto"  class="badge badge-pill badge-primary">Chờ báo giá </span>
        <?php }if($TrangThai==1) { ?>
          <span style="background-color: #cd9513;width: auto;height: auto" class="badge badge-pill badge-warning">Chờ lãnh đạo phòng quản trị duyệt</span>
           <?php } if($TrangThai==2) {?>
          <span style="width: auto;height: auto"  class="badge badge-pill badge-success">Chờ ban giám hiệu duyệt</span>
        <?php } if($TrangThai==3) {?>
          <span  style="width: auto;height: auto"  class="badge badge-pill badge-success">Đã duyệt</span>
        <?php  }if($TrangThai==4) {?>
          <span style="width: auto;height: auto" class="badge badge-pill badge-dark">Phiếu không được duyệt</span>
        <?php  }if($TrangThai==5) {if(isset($_SESSION['YCTBVT'])){?>
          <span  style="background-color: #7ec960;width: auto;height: auto"class="badge badge-pill badge-info">Chờ thêm vật tư</span>
          <label for="">Sửa thông tin đề xuất</label>
          <input type="checkbox" id="checkedit" name="edit">
          <button  style="background-color: #217346" type="submit" name="edit" id="show" class="hidden">Sửa</button>

        <?php  }}if($TrangThai==6) {if($_SESSION['QLK']){?>
          <span style="background-color: #b0afab;width: auto;height: auto"class="badge badge-pill badge-dark">Chờ nhân viên quản lý kho duyệt</span>
            <label for="">Sửa thông tin đề xuất</label>
          <input type="checkbox" id="checkedit" name="edit">
          <button  style="background-color: #217346" type="submit" name="edit" id="show" class="hidden">Sửa</button>
        <?php  }}if($TrangThai==7 ||$TrangThai==9) {?>
          <span style="width: auto;height: auto"class="badge badge-pill badge-danger">Không duyệt phiếu</span>
          <?php  }if($TrangThai==8) {if($_SESSION['DP_LDDV']) {?>
          <span style="width: auto;height: auto;background-color: #98979669" class="badge badge-pill badge-dark">Chờ lãnh đạo đơn vị duyệt</span>
            <label for="">Sửa thông tin đề xuất</label>
          <input type="checkbox" id="checkedit" name="edit">
          <button  style="background-color: #217346" type="submit" name="edit" id="show" class="hidden">Sửa</button>
          <?php  }}if($TrangThai==10) {?>
          <span style="background-color: #b7ab8a;width: auto;height: auto" class="badge badge-pill badge-dark">Chờ tổng hợp</span>
          <div style="float:right;">
           
          </div>
        <?php } ?>


      </div>
      <?php if($HPCB >0) {?>
         <div class="form-group  col-lg-6">
          <label for="">Đơn giá chuẩn</label>
          <input class="form-control  overflow" type="text"  value="<?php echo number_format($HocPhiCoBan); ?> VNĐ" disabled="">
        </div>
      <?php } ?>
    </div>
  </form>
  <?php 
  if ($TrangThai==1 && isset($HocPhiCoBan))
  {
  $sqlTC = "SELECT SoTinChi FROM monhoc WHERE MaMon='$MonHoc'";
  $queryTC = mysqli_query($connect, $sqlTC);
 $rowTC = mysqli_fetch_assoc($queryTC);

$tmp = $rowK['HeSoK'] -1;
  $tien1 = ($HocPhiCoBan * $tmp * $rowTC['SoTinChi']) ;
  //echo number_format($tien1);

   $tien2 = $TongTien / $SLSV ;
  //echo number_format($tien2);

if ($tien1 > 0)
{
  $tien3 = ( $tien2 / $tien1 ) * 100;
  echo "Tỷ lệ phần trăm sau khi tính với hệ số K: ";
} 
else 
{
  echo "<script>alert('Vui lòng nhập học phí > 0')</script>";
}
  if (isset($tien3))
{

  ?>
  <label <?php if ($tien3 > 100){ ?> style="color:red" <?php } ?>class="form-control-label"><?php echo number_format($tien3). '%'?></label>
<?php } }?>

  <div class="table-responsive" >
    <?php if($TrangThai==0) { ?>
      <div>
        <form name='import' method="POST" enctype="multipart/form-data">
          <div class="submit" style="float: left;margin-right: 1px">
            <!--    <button  style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"></i> Import</button> -->
            <input data-toggle="collapse" href="#collapse" class="collapsed" id="file-upload" type="file" name="file" multiple style='display: none;'>
            <button id="collapse" class="panel-collapse collapse" type="submit" name="import">Nhập excel</button>
          </div>
        </form>
        <?php if(isset($_SESSION['BG'])){ ?>
          <div style="float:right;">
            <input type="button" id="savedl" onclick="window.location.href='cap-nhat-chi-tiet-phieu-ycvt.php?MaHD=<?php echo $MaHD ?>'" value="Báo giá [<?php echo $SL; ?>]"/>
          </div>
        <?php } ?>
            <!--
              <input type="button" style="background-color: #ff0000d6;float: right;" data-toggle="modal" data-target="#myModal" value="Hủy đơn"/> -->
            </div>
          <?php } elseif($TrangThai ==5) {?>
            <div>
              <form name='import' method="POST" enctype="multipart/form-data">
                <div class="submit" style="float: left;margin-right: 1px">
                  <button  style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"></i> Import</button>
                  <input data-toggle="collapse" href="#collapse" class="collapsed" id="file-upload" type="file" name="file" multiple style='display: none;'>
                  <button id="collapse" class="panel-collapse collapse" type="submit" name="import">Nhập excel</button>
                </div>
              </form>
              <?php if($SL >0)   { if(isset($_SESSION['YCTBVT'])) {?>
                <input style="float:right;"  type="button" id="savedl" onclick="window.location.href='cap-nhat-table-import.php?MaHD=<?php echo $MaHD ?>'" value="Chỉnh sửa chi tiết"/>
              <?php }} ?>
              <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">Thêm chi tiết</button>
              <?php if($SL >0) {?>
               <a href="export-chi-tiet-phieu-yeu-cau-trang-bi.php?id=<?php echo $_GET['MaHD'] ?>"><button  type="submit" class="callback"  name="import">Xuất excel</button> </a>
             <?php } ?>
             <!--  <input type="button" style="background-color: #ff0000d6;float: right;" onclick="window.location.href='huy-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $MaHD ?>'" value="Hủy đơn"/> -->
             <div>
              <a onclick="return confirm('Bạn có muốn xóa')" href="xoa-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $MaHD ?>"><input  type="button" style="background-color: #ff0000d6;float: right;"  value="Hủy"/></a>
              <?php if($SL >0) {?>
                <form action="" method="post">
                  <button  style="float: right;" type="submit" name="guiphieu"  >Gửi phiếu</button>
                </form>
              <?php } ?>
            </div>
          </div>
 
        <?php }elseif($TrangThai==7) {?>
          <div>
              <form name='import' method="POST" enctype="multipart/form-data">
                <div class="submit" style="float: left;margin-right: 1px">
                  <button  style="background-color: #217346" type="submit" name="file" name="import"class="addfiles"><i class="ti-upload"></i> Import</button>
                  <input data-toggle="collapse" href="#collapse" class="collapsed" id="file-upload" type="file" name="file" multiple style='display: none;'>
                  <button id="collapse" class="panel-collapse collapse" type="submit" name="import">Nhập excel</button>
                </div>
              </form>
              <?php if($SL >0) {?>
                <input style="float:right;"  type="button" id="savedl" onclick="window.location.href='cap-nhat-table-import.php?MaHD=<?php echo $MaHD ?>'" value="Chỉnh sửa chi tiết"/>
              <?php } ?>
              <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">Thêm chi tiết</button>
              <?php if($SL >0) {?>
               <a href="export-chi-tiet-phieu-yeu-cau-trang-bi.php?id=<?php echo $_GET['MaHD'] ?>"><button  type="submit" class="callback"  name="import">Xuất excel</button> </a>
             <?php } ?>
             <!--  <input type="button" style="background-color: #ff0000d6;float: right;" onclick="window.location.href='huy-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $MaHD ?>'" value="Hủy đơn"/> -->
             <div>
              <a onclick="return confirm('Bạn có muốn xóa')" href="xoa-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $MaHD ?>"><input  type="button" style="background-color: #ff0000d6;float: right;"  value="Hủy"/></a>
               <?php if($SL >0) {?>
                <form action="" method="post">
                  <button  style="float: right;" type="submit" name="guiphieu"  >Gửi phiếu</button>
                </form>
              <?php } ?>
        <?php }elseif($TrangThai==6) {  if (isset($_SESSION["QLK"])) {?>
            <form action="" method="post">
              <button   type="reset" name="qlkhuyt"  >Không duyệt phiếu</button>
            <button  style="float: right;" type="submit" name="qlkduyet"  >Duyệt phiếu</button>
              <input style="float:right;"  type="button" id="savedl" onclick="window.location.href='cap-nhat-table-import.php?MaHD=<?php echo $MaHD ?>'" value="Chỉnh sửa chi tiết"/>
              </form>
             <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">Thêm chi tiết</button>

          <?php }} elseif($TrangThai==8) {  if (isset($_SESSION["DP_LDDV"])) {?>
            <form action="" method="post">
                <button   type="reset" name="qldvhuy"  >Không duyệt phiếu</button>
            <button  style="float: right;" type="submit" name="qldvduyet"  >Duyệt phiếu</button>
              </form>
              <button data-toggle="collapse" href="#collapse1" class="collapsed"  style="background-color: #217346" type="submit">Thêm chi tiết</button>

          <?php }} elseif($TrangThai==1) {  if (isset($_SESSION["DP_LDPQT"])) {?>
            <form action="" method="post">
              <button   type="reset" name="hphuy"  >Không duyệt phiếu</button>
            <button  style="float: right;" type="submit" name="ldpqtduyet"  >Duyệt phiếu</button>
              </form>
           <?php }} elseif($TrangThai==2) {  if (isset($_SESSION["DP_BGH"])) {?>
            <form action="" method="post">
               <button   type="reset" name="hphuy"  >Không duyệt phiếu</button>
            <button  style="float: right;" type="submit" name="hpduyet"  >Duyệt phiếu</button>
              </form>
          <?php }} elseif($TrangThai==3) { ?>
            <div id="row" >
       <a href="http://localhost:8888/Report/public/report?id=<?php echo $MaHD ?>"><button  type="submit" class="callback"  name="import">Report</button> </a>
          </div>
         <?php } elseif($TrangThai==10)  {if(isset($_SESSION['DP_NVPQT'])) { ?>
            <div id="row" >
     <input type="button" id="savedl" onclick="window.location.href='cap-nhat-chi-tiet-phieu-ycvt.php?MaHD=<?php echo $MaHD ?>'" value="Báo giá [<?php echo $SL; ?>]"/>
          </div>
         <?php }} ?>

          
        <div  class="content mt-3 " style="padding: 0;">
          <div class="animated fadeIn">
            <div class="row">
              <div id="collapse1" class="col-lg-12 panel-collapse collapse">

                <div class="card" >

                  <div class="card-header">

                    <strong>Thêm chi tiết yêu cầu vật tư</strong>
                  </div >




                  <div class="card-body card-block">


                    <form action="" method="post" class="">
                      <div class="wrapper">

                        <div  style="display: flex;">
                          <div style="width: 90%;" id="lbform" class="form-control-label">
                            <label  class="form-control-label">Mã vật tư</label>
                          </div>
                          <div style="width: 90%;" id="lbform" class="form-control-label">
                            <label  class="form-control-label">Tên vật tư</label>
                          </div>
                          <div style="width: 90%;"id="lbform" class="form-control-label">
                            <label class="form-control-label">Đơn vị tính </label>
                          </div>
                          <div style="width: 90%;" id="lbform" class="form-control-label">
                            <label class="form-control-label">Số lượng</label>
                          </div>
                            <div style="width: 90%;"id="lbform" class="form-control-label">
                            <label class="form-control-label">Đơn Giá gợi ý</label>
                          </div>
                          <div style="width: 90%;"id="lbform" class="form-control-label">
                            <label class="form-control-label">Thông số kỹ thuật</label>
                          </div>
                          <div style="width: 90%;"id="lbform" class="form-control-label">
                            <label class="form-control-label">Xuất xứ</label>
                          </div>
                          <div style="width: 90%;"id="lbform" class="form-control-label">
                            <label class="form-control-label">Ghi chú</label>
                          </div>
                         
                          <div style="width: 178px;"id="lbempty" class="form-control-label">
                            <label class="form-control-label"></label>
                          </div>
                        </div>
                        <div  style="display: flex;">
                          <div style="width: 110%"class="form-group">
                            <input type="text" name="mavt[]" value="" placeholder="Nhập vào mã vật tư"class="form-control" >
                          </div>
                          <div style="width: 110%"class="form-group">
                            <input type="text" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư"class="form-control" >
                          </div>
                          <div style="width: 110%"class="form-group">
                            <input type="text" value="" name="dvtinh[]" placeholder="Đơn vị tính"class="form-control" required>
                          </div>
                          <div style="width: 110%"class="form-group">
                            <input type="number" value="" name="sl[]" placeholder="Số lượng "class="form-control" required>
                          </div>
                          <div style="width: 110%"class="form-group">
                            <input type="number" value="" name="goiydg[]" placeholder="Gợi ý đơn giá "class="form-control" >
                          </div>
                          <div style="width: 110%"class="form-group">
                            <input type="text" value="" name="thongso[]" placeholder="Thông số kỹ thuật"class="form-control" >
                          </div>
                          <div style="width: 110%"class="form-group">
                            <input type="text" value="" name="xuatxu[]" placeholder="Xuất xứ"class="form-control" >
                          </div>
                          <div style="width: 110%"class="form-group">
                            <input type="text" value="" name="ghichu[]" placeholder="Ghi chú"class="form-control" >
                          </div>
                           
                          <div class="form-group">
                            <div id="add_fields" class="add_fields input-group-addon"><i class="fa fa-plus-square"></i></div>

                          </div>
                        </div>
                      </div>
                      <div id="row" >
                        <div class="submit" style="float: right;margin-right: 1px">

                          <button type="submit" name="submit" >
                            Lưu
                          </button>
                          <button type="reset" >
                            Đặt lại
                          </button>
                        </div>

                      </div>
                      <br>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 600px;">
              <div class="modal-body modal-body-sub_agile">
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                <div class="card-body card-block">
                  <h3 style="text-align: center;" class="agileinfo_sign">Không duyệt phiếu</h3>
                  <p style="width: 50px;"></p>
                  <form action="" method="post"  >
                    <div class=" form-group">
                      <input type="text" placeholder="Nhập lý do không duyệt" name="LyDoHuy" class="form-control">
                    </div>
                    <button class="btn btn-outline-danger" style="float:right;"type="submit" name="huy">Không duyệt</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php 
        if ($TrangThai==1 && isset($rowK["HeSoK"])) {
         ?>
         <div class="card-body card-block">
                  <h3 style="text-align: center;" class="agileinfo_sign">Đơn giá chuẩn</h3>
                  <p style="width: 50px;"></p>
                  <form action="" method="post"  >
                    <div class=" form-group">
                      <input type="text" placeholder="Nhập đơn giá chuẩn" name="hocphi" class="form-control">
                    </div>
                    <button class="btn btn-outline-danger" style="float:right;"type="submit" name="luuhocphi">Lưu</button>
                  </form>
                </div>
              <?php } ?>
        <div class="modal fade" id="myModalduyet" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 600px;">
              <div class="modal-body modal-body-sub_agile">
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
               
              </div>
            </div>
          </div>
        </div>
        <div style="float:left;display: flex;width: 100%;">
          <br>

          <table class="table table-bordered table-striped" style="">
            <thead>
              <th>STT</th>
               <th width="">Mã vật tư</th>
              <th width="">Tên vật tư</th>
              <th width="">Đơn vị tính</th>
              <th width="">Số lượng</th>
              <?php if(isset($_SESSION['YCTBVT']) || isset($_SESSION['QLK']) || isset($_SESSION['DP_LDDV']) || isset($_SESSION['DP_NVPQT'])) { ?>
              <th width="">Gợi ý đơn giá</th>
            <?php } ?>
             <th width="">Đơn giá</th>
            <th width="">Thành tiền</th>
                 <th width="">Thông số KT</th>
              <th width="">Xuất xứ</th>
              <th width="">Ghi chú</th>
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
              <?php if(isset($_SESSION['YCTBVT']) || isset($_SESSION['QLK']) || isset($_SESSION['DP_LDDV']) || isset($_SESSION['DP_NVPQT'])) { ?>
               <td><?php echo number_format($row['GoiYDG']) ?> VNĐ</td>
                  <?php }if(isset($_SESSION['DP_NVPQT']) || isset($_SESSION['DP_LDPQT']) || isset($_SESSION['DP_BGH'])){ ?>
                  <td><?php echo number_format($row['DonGia']) ?> VNĐ</td> 
              <td><?php echo number_format($row['ThanhTien']) ?> VNĐ</td> 
            <?php } ?>
                  <td><?php echo $row['ThongSoKT'] ?></td>
                <td><?php echo $row['XuatXu'] ?></td>
                <td><?php echo $row['GhiChu'] ?></td>
                
              </tbody>
            <?php  } ?>
          </table>
          <br>


        </div>
      </div>

    </div>
  </div>
</div>

</div>
<?php include 'scriptindex.php'; ?>
<script src="assets/js/my.js"></script>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
</body>
</html>
<script>
  $('.addfiles').on('click', function() { $('#file-upload').click();return false;});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('input[type="file"]').change(function(e){
      var fileName = e.target.files[0].name;
      $(this).prev('button').text(fileName);
    });
  });
</script>
<script>
//Add Input Fields
   $(document).ready(function() {
var max_fields = 20; //Maximum allowed input fields
var wrapper    = $(".wrapper"); //Input fields wrapper
var add_button = $("#add_fields"); //Add button class or ID
var x = 1; //Initial input field is set to 1
//When user click on add input button
$(add_button).click(function(e){
  e.preventDefault();
//Check maximum allowed input fields
if(x < max_fields){
  x++;
  var selectPattern = $('#catalog-pattern').clone().html();
  $(wrapper).append('<div> <div  style="display: flex;"> <div style="width: 110%"class="form-group"><input type="text" name="mavt[]" value="" placeholder="Nhập vào mã vật tư"class="form-control" > </div><div style="width: 110%"class="form-group"><input type="text" name="tenvt[]" value="" placeholder="Nhập vào tên vật tư"class="form-control" > </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="dvtinh[]" placeholder="Đơn vị tính"class="form-control" required> </div>  <div style="width: 110%"class="form-group"> <input type="number" value="" name="sl[]" placeholder="Số lượng "class="form-control" required> </div><div style="width: 110%"class="form-group"><input type="text" name="goiydg[]" value="" placeholder="Gợi ý đơn giá"class="form-control" > </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="thongso[]" placeholder="Thông số kỹ thuật"class="form-control" >  </div> <div style="width: 110%"class="form-group">  <input type="text" value="" name="xuatxu[]" placeholder="Xuất xứ"class="form-control" > </div> <div style="width: 110%"class="form-group"> <input type="text" value="" name="ghichu[]" placeholder="Ghi chú"class="form-control" >  </div>  <a href="javascript:void(0);" class="remove_field"><div class="input-group-addon"><i class="fa fa-minus-square"></i></div></a></div></div>');
}
});
//when user click on remove button
$(wrapper).on("click",".remove_field", function(e){
  e.preventDefault();
$(this).parent('div').remove(); //remove inout field
x--;
})
});
</script>
<script>
  function goBack() {
    window.history.back();
  }
   console.log('0:báo giá');
  console.log('1:Chờ lãnh đạo phòng quản trị duyệt');
     console.log('2:Chờ ban giám hiệu duyệt');
     console.log('3:đã duyệt');
     console.log('4:không duyệt phiếu');
  console.log('5:chờ thêm vật tư');
  console.log('6:chờ nhân viên quản lý kho duyệt');
  console.log('7:không duyệt phiếu trả về giảng viên');
  console.log('8:chờ lãnh đạo đơn vị duyệt');
    console.log('9:không duyệt phiếu trả về nhân viên qlk');
  // console.log('10:chờ nhân viên phòng quản trị duyệt');
  console.log('10:chờ tổng hợp');
 console.log('11: đã tổng hợp');
  console.log('12: đã nhập kho');

</script>