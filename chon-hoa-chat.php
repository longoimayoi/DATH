<?php include 'header.php'; ?>
<?php include 'connect/myconnect.php';
?>
<body>
  <?php include 'leftpanel.php' ; ?>
  <div class="container">
    <br />
    <div class="table-responsive">
      <h3 align="center">CHỌN VẬT TƯ</h3><br />
      <div class="card-title">
        <form class="search" method="post" action="">
          <input class="text" type="text" id ="skill_input" name ="btn_search" type="search" placeholder= "Nhập vào tên vật tư cần tìm..." value = "<?php echo isset($_POST["btn_search"]) ? $_POST["btn_search"] : ""; ?>" autocomplete="off">
          <i class="fa fa-search"></i>
        </form>
      </div>
      <?php
      if (isset($_POST["btn_list"]))
      {
      echo("<script>location.href = '"."cart.php';</script>");
      }
      if (isset($_POST["btn_back"]))
      {
      /* header ('Location: '.$_SERVER['HTTP_REFERER']);*/
      echo("<script>location.href = '"."require.php';</script>");
      }
      if (isset($_POST["btn_denghi"]))
      {
      /* header ('Location: '.$_SERVER['HTTP_REFERER']);*/
      echo("<script>location.href = '"."de-nghi.php';</script>");
      }
      ?>
      <form method = "post">
        <div align="left">
          <button type="submit" name="btn_list" class="btn btn-info">Danh sách đã chọn <?php
          if (!isset($_SESSION['cart']))
          echo '[0]';
          else{
          $items = $_SESSION['cart'];
          echo '['.count($items).']';}
          ?></button>
          <!-- <button type="submit" style="background-color: #ff0000d6"name="btn_back">Quay lại</button> -->
          <!--   <p align="right"><button type="submit" name="btn_denghi">Lưu danh sách</button></p> -->
        </div>
        <!--  <div align="right">
          <input type="submit" name="delete" id="delete" class="btn btn-danger" value="Xóa dữ liệu" />
        </div> -->
      </form>
      <form method="post">
        <br />
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <th width="40%">Tên vật tư</th>
              <th width="40%">Đơn vị tính</th>
              <th width="2%"></th>
            </thead>
            <tbody>
              <?php
              if (!isset($_POST["btn_search"]))
              {
              $sql = "Select * from tblhoachat";
              $query = mysqli_query($connect, $sql);
              while ($row = mysqli_fetch_row($query))
              {
              echo "<tr>";
                echo '<td>'."$row[3]".'</td>';
                echo '<td>'."$row[5]".'</td>';
                echo '<td><a href = '."selectlist.php?item=$row[0]".'><span style="color:#007bffeb"class="ti-check-box"></span></a></td>';
              echo "</tr>";
              }
              }
              else
              {
              $search = $_POST["btn_search"];
              if ($search == "")
              {
              $sql = "Select * from tblhoachat";
              $query = mysqli_query($connect, $sql);
              while ($row = mysqli_fetch_row($query))
              {
              echo "<tr>";
                echo '<td>'."<p>$row[3]" . "</p>".'</td>';
                echo '<td>'."<p>$row[5]" . "</p>".'</td>';
                echo '<td><a href = '."selectlist.php?item=$row[0]".'>Chọn</a></td>';
              echo "</tr>";
              }
              }
              else
              {
              $sql_search = "Select * from tblhoachat where TenHoaChat like '%$search%'";
              $query = mysqli_query($connect, $sql_search);
              if (mysqli_num_rows($query) > 0)
              while ($row = mysqli_fetch_row($query))
              {
              echo "<tr>";
                echo '<td>'."<p>$row[3]" . "</p>".'</td>';
                echo '<td>'."<p>$row[5]" . "</p>".'</td>';
                echo '<td><a href = '."selectlist.php?item=$row[0]".'>Chọn</a></td>';
              echo "</tr>";
              }
              else
              {
              echo "Không tìm thấy vật tư ".$search;
              }
              }
              }
              ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
  <script>
  $(function() {
  $("#skill_input").autocomplete({
  source: "chemistry_name.php",
  });
  });
  </script>
  <?php include 'scriptindex.php'; ?>
</body>
</html>