<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');?>
<body>
  <?php include 'leftpanel.php' ; ?>
  <!-- Left Panel -->
  <!-- Right Panel -->
  <!-- /header -->
  <!-- Header-->
  <?php
  if(!isset($_GET["btn_Search"]))
  {
  $id = $_SESSION['uid'];
  $name = $_SESSION['Username'];
  }
  else
  {
  $username = $_GET["btn_Search"];
  $sqlsearch = "SELECT MaTK from tbltaikhoan where TenDangNhap='{$username}'";
  $query = mysqli_query($connect,$sqlsearch);
  if (mysqli_num_rows($query)==1)
  {
  $row = mysqli_fetch_assoc($query);
  $id = $row["MaTK"];
  $name = $username;
  }
  else
  {
  echo "<script>alert('Không tìm thấy tài khoản vừa nhập!');</script>";
  $id = $_SESSION['uid'];
  $name = $_SESSION['Username'];
  }
  }
  
  if (isset($_POST["btn_Save"]))
  {
  $c=$_POST["check"];
  $d=implode(",",$c);
  $sqlthem = "UPDATE tbltaikhoan set  MaQH ='$d' WHERE MaTK=".$id;
  $query = mysqli_query($connect, $sqlthem);
  }
  ?>
  
  <div class="content mt-3">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <strong>PHÂN QUYỀN TÀI KHOẢN</strong>
            </div>
            <div class="card-body card-block">
              <div id="title">
                <span>Tài khoản <?php echo $name ?></span>
              </div>
              <div id="finduser">
                <form action="" method="get"class="search form-horizontal">
                  
                  <input class="text" type="text" id ="skill_input" name ="btn_Search" type="search" placeholder= "Nhập vào tên tài khoản cần tìm..." value = "<?php echo isset($_GET["btn_Search"]) ?
                 $_GET["btn_Search"] : $_SESSION['Username']; ?>" autocomplete="off">
                  <i class="fa fa-search"></i>
                </form>
              </div>
              
              <form method="post">
                
                <br>
                <br>
                <?php
                $sqltk = "SELECT MaQH FROM tbltaikhoan WHERE MaTK =".$id;
                $querytk = mysqli_query($connect, $sqltk);
                $rowtk = mysqli_fetch_array($querytk,MYSQLI_ASSOC);
                $a=$rowtk["MaQH"];
                $b=explode(",",$a);
                $sql = "SELECT * FROM tblquyenhan ORDER BY TenQH";
                $query = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
                {
                ?>
                <div id="phanquyen" >
                  <input class="checkbox" id="checkbox" style="float:right;" type="checkbox" value="<?php echo $row['MaQH']; ?>" name="check[]" <?php
                  if(in_array($row["MaQH"],$b))
                  {
                  echo "checked";
                  }
                  ?> />
                  <label class="col-md-8 offset-md-2">
                     <!-- style="text-transform: none;" style cho lable chữ thường-->
                    <span></span>
                    <?php echo $row['TenQH']; ?>
                           </label>

                  
                  
                </div>
                <?php } ?>
                <hr>
                
                <div style="text-align: center" >
                  <button type="submit" name="btn_Save">LƯU QUYỀN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(function () {
  $("#skill_input").autocomplete({
  source: "search-tai-khoan.php",
  });
  });
  </script>
  <?php include 'scriptindex.php'; ?>
</body>
</html>