<link href="khoa/css/demo-page.css" rel="stylesheet" media="all">
<link href="khoa/css/imagehover.min.css" rel="stylesheet" media="all">
<?php
include 'header.php'; ?>
<?php include('connect/myconnect.php');
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<body>
    <?php include 'leftpanel.php' ; ?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                
                <div class="col-lg-12">
                    <div style="background: transparent; border: none"class="card" >
                        <div style="background: transparent; border: none; font-size: 20px" class="card-header">
                            <strong>DANH SÁCH KHOA</strong>
                        </div >
                        <div style="margin: 0 auto;"class="card-body card-block">
                            
                            <?php
                            $soTT = 0;
                            $sql = "SELECT MaKhoa, TenKhoa, Hinh FROM tblkhoa WHERE Loai = 1";
                            $query = mysqli_query($connect, $sql);
                            while ($row = mysqli_fetch_array($query)) {
                            $soTT ++;
                            ?>
                 
                              <div class="col-md-6">
                                <div class="card">
                                    <div style="cursor: pointer;"onclick="window.location.href='mon-hoc.php?id=<?php echo $row['MaKhoa'] ?>'" class="card-body">
                                        <div style="height: 200px;" class="mx-auto d-block">
                                            <img style="height: 80%" class="rounded-circle mx-auto d-block" src="images/<?php echo $row[2]?>" alt="Card image cap">
                                            <h5 class="text-sm-center mt-2 mb-1"><?php echo $row[1] ?></h5>
                                            
                                        </div>
                                     
                                    </div>
                            
                                </div>
                            </div>

                            
                            <?php } ?>

     
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'scriptindex.php'; ?>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-74717651-1', 'auto');
    ga('send', 'pageview');
    </script>
</body>