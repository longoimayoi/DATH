</!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    <?php
    if(isset($_POST['ok_upload']))
    {
    $num=$_GET['file'];
    $conn=mysqli_connect("localhost","root","") or die("can't connect your database");
    mysqli_select_db($conn, "dath");
    for($i=0; $i< $num; $i++)
    {
    move_uploaded_file($_FILES['img']['tmp_name'][$i],"data/".$_FILES['img']['name'][$i]);
    $url="data/".$_FILES['img']['name'][$i];
    $name=$_FILES['img']['name'][$i];
    $sql="insert into images(img_url,img_name) values('$url','$name')";
    mysqli_query($sql);
    echo "Upload Thanh cong file <b>$name</b><br />";
    echo "<img src='$url' width='120' /><br />";
    echo "Images URL: <input type='text' name='link' value='$site/$url' size='35' /><br />";
    
    }
    mysql_close($conn);
    }
    else
    {
    echo "Vui long chon hinh truoc khi truy cap vao trang nay";
    }
    ?>
    <?php
    if(isset($_POST['ok_num']))
    {
    $num=$_POST['txtnum'];
    echo "<hr />";
    echo "Ban dang chon $num dong<br />";
    echo "<form action='doupload.php?file=$num' method='post' enctype='multipart/form-data'>";
      for($i=1; $i <= $num; $i++)
      {
      echo   '<div style="padding-top: 7px;">';
        
        
        echo '<select parent="danhmuc" name="parent" selected>';
          
          echo   '$query_dm="SELECT * FROM tbldanhmuc   ORDER BY MaDanhMuc ASC   ";';
          echo '$result_dm=mysqli_query($connect,$query_dm);';
          echo   'while ($danhmuc=mysqli_fetch_array($result_dm,MYSQLI_ASSOC)) {';
          
          echo   '<option  <?php if(($danhmuc["TenDanhMuc"])==$parent)';
            echo '{' ;
            
            echo  'selected="selected"  }';
          echo '($danhmuc["TenDanhMuc"]); </option>;';
          
          
          echo '}';
          
        echo  '</select>';
        
        
      echo '</div>';
      }
      echo "<input type='submit' name='ok_upload' value='Upload' />";
    echo "</form>";
    }
    ?>
    <form method="post">
      Enter your row: <input type="text" name="txtnum" value="<?php echo $_POST['txtnum']; ?>" size="10" />
      <input type="submit" name="ok_num" value="Accept" />
    </form>
  </body>
</html>