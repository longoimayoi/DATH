<?php
include 'header1.php'; ?>
<?php include('connect/myconnect.php');
?>
<link href="assets/demo-page.css" rel="stylesheet" media="all">
<link href="assets/hover.css" rel="stylesheet" media="all">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">
<body>
    <?php include 'leftpanel.php' ; ?>
    <div class="content mt-3">
        <div class="animated fadeIn">
            
            <div style="background: transparent; border: none; font-size: 20px" class="card-header">
                <strong>DANH MỤC VẬT TƯ</strong>
            </div >
            <br>
            <div style="margin:0"class="row">
                <?php
                $soTT = 0;
                $sql = "SELECT  MaDanhMuc , TenDanhMuc,HinhAnh FROM tbldanhmuc";
                $query = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($query)) {
                $soTT ++;
                ?>
                <div class="col-md-2 hvr-buzz-out">
                    <div class="card">
                        <img  style="height: 120px"class="card-img-top" src="images/<?php echo $row[2] ?>" alt="Card image cap">
                        <div style="height:65px;" class="card-body hvr-shutter-out-horizontal">
                            <h4 style="text-align: center;margin-top:-10px;font-size:15px"class="card-title mb-3 "><a style="color: #212529"href="detail.php?MaDanhMuc=<?php echo $row[0];?>"><?php echo $row[1] ?></a></h4>
                        </div>
                    </div>
                </div>
               
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include 'scriptindex.php'; ?>
    <script>
    /**
    * Used to demonstrate Hover.css only. Not required when adding
    * Hover.css to your own pages. Prevents a link from being
    * navigated and gaining focus.
    */
    var effects = document.querySelectorAll('.effects')[0];
    effects.addEventListener('click', function(e) {
    if (e.target.className.indexOf('hvr') > -1) {
    e.preventDefault();
    e.target.blur();
    }
    });
    </script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^https:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-11991680-4', 'ianlunn.github.io');
    ga('send', 'pageview');
    </script>
</body>