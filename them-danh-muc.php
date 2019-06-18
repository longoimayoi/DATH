<?php include 'header.php'; ?>
<?php include('connect/myconnect.php');?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<body>
    <?php include 'leftpanel.php' ; ?>
    
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thêm danh mục</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="" method="post" class="">
                                <div class="form-group">
                                    <label for="nf-email" class=" </p>form-control-label">Tên danh mục</label>
                                    <div class="wrapper">
                                        <div class="input-group">
                                            
                                            <input type="text" name="tendm[]" placeholder="Nhập tên danh mục...."class="form-control" required>   <div class="add_fields input-group-addon"><i class="fa fa-plus-square"></i></div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <!--  <p><button class="add_fields">+</button></p> -->
                                <div id="row" >
                                    <div class="submit" style="float: right;margin-right: 1px">
                                        <button type="submit" name="btn_submit" >
                                        Lưu
                                        </button>
                                        <button type="reset" >
                                        Đặt lại
                                        </button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'scriptindex.php'; ?>
    <?php
    if(isset ($_POST["btn_submit"]))
    {
    
    if (isset($_POST["tendm"]) && is_array($_POST["tendm"])){
    $tendm = array_filter($_POST["tendm"]);
    foreach($tendm as $key => $value){
    $sql1 = "INSERT INTO tbldanhmuc
    (TenDanhMuc)
    VALUES
    ('$value')";
    $query = mysqli_query($connect,$sql1);
    }
    echo "Thêm danh mục thành công !";
    echo("<script>location.href = '"."category.php';</script>");
    
    }
    }
    /*$message = "Them thanh cong";
    echo "<script type='text/javascript'>alert('$message');</script>";*/
    
    ?>
</body>
</html>
<script>
//Add Input Fields
$(document).ready(function() {
var max_fields = 20; //Maximum allowed input fields
var wrapper    = $(".wrapper"); //Input fields wrapper
var add_button = $(".add_fields"); //Add button class or ID
var x = 1; //Initial input field is set to 1

//When user click on add input button
$(add_button).click(function(e){
e.preventDefault();
//Check maximum allowed input fields
if(x < max_fields){
x++; //input field increment
//add input field
$(wrapper).append('<div class="input-group"><input type="text" name="tendm[]" placeholder="Nhập tên danh mục...." class="form-control"required> <a href="javascript:void(0);" class="remove_field"><div class="input-group-addon"><i class="fa fa-minus-square"></i></div></a></div>');
//$(wrapper).append(');
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