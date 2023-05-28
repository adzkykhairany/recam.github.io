<!DOCTYPE html>
<html>

<?php
include('session_client.php');
if (isset($_POST['update'])) {
    $camera_id = $_POST['camera_id'];
    $camera_name = $_POST['camera_name'];
    $tipe_camera = $_POST['tipe_camera'];
    $lensa_price_per_day = $_POST['lensa_price_per_day'];
    $tl_price_per_day = $_POST['tl_price_per_day'];
    $uploadedimage = $_FILES['uploadedimage'];
    $result = mysqli_query($conn, "UPDATE cameras SET camera_name='$camera_name', tipe_camera='$tipe_camera',lensa_price_per_day='$lensa_price_per_day',tl_price_per_day='$tl_price_per_day' 
    WHERE camera_id='$camera_id'");
    header("Location:entercamera.php");
}
@$camera_id = $_GET['camera_id'];
$result = mysqli_query($conn, "SELECT * FROM cameras WHERE camera_id IN (SELECT camera_id FROM clientcameras WHERE client_username='$user_check');");
while ($row = mysqli_fetch_array($result)) {
    $camera_name = $row['camera_name'];
    $tipe_camera = $row['tipe_camera'];
    $lensa_price_per_day = $row['lensa_price_per_day'];
    $tl_price_per_day = $row['tl_price_per_day'];
    //$uploadedimage = $row['uploadedimage'];
} ?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    RECAM </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <?php
            if (isset($_SESSION['login_client'])) {
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">HOME</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Halo <?php echo $_SESSION['login_client']; ?></a>
                        </li>
                        <li>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="cameraet"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="entercamera.php">Tambah camera</a></li>

                                        <li> <a href="clientview.php">View</a></li>
                                        <li> <a href="viewaduan.php">View Aduan</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>
                    </ul>
                </div>

            <?php
            } else if (isset($_SESSION['login_customer'])) {
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">HOME</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Halo <?php echo $_SESSION['login_customer']; ?></a>
                        </li>
                        <li>
                            <a href="#">History</a>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>
                    </ul>
                </div>

            <?php
            } else {
            ?>

                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">HOME</a>
                        </li>
                        <li>
                            <a href="clientlogin.php">Staff</a>
                        </li>
                        <li>
                            <a href="customerlogin.php">CUSTOMER</a>
                        </li>
                        <li>
                            <a href="faq.php"> FAQ </a>
                        </li>
                    </ul>
                </div>
            <?php   }
            ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="update.php" enctype="multipart/form-data" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Update detail </h3>

                    <div class="form-group">
                        <label for="camera_name">Nama Kamera : </label>
                        <input type="text" class="form-control" id="camera_name" name="camera_name" value="<?php echo $camera_name; ?>" required autofocus="">
                    </div>
                    <div class="form-group">
                        <label for="camera_name">Tipe Kamera : </label>
                        <select name="tipe_camera" class="form-control" id="tipe_camera" value="<?php echo $tipe_camera; ?>" required>
                            <option value="tipekamera">--tipe kamera--</option>
                            <option value="dslr">DSLR</option>
                            <option value="mirrorless">Mirrorless</option>
                            <option value="poket">Poket</option>
                            <option value="ac">Action Cam</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="camera_name">Harga dengan lensa per hari (Rp) : </label>
                        <input type="text" class="form-control" id="lensa_price_per_day" name="lensa_price_per_day" value="<?php echo $lensa_price_per_day; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="camera_name">Harga tanpa lensa per hari (Rp) : </label>
                        <input type="text" class="form-control" id="tl_price_per_day" name="tl_price_per_day" value="<?php echo $tl_price_per_day; ?>" required>
                    </div>


                    <div class="form-group">
                        <input name="uploadedimage" type="file" value="<?php echo $uploadedimage; ?>">
                    </div>
                    <div class="form-group">
                        <input name="camera_id" type="hidden" value="<?php echo $camera_id; ?>">
                    </div>
                    <button type="submit" id="submit" name="update" class="btn btn-success pull-right"> Ubah</button>
                </form>
            </div>
        </div>



    </div>
</body>
<footer class="site-footer">
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h5>© <?php echo date("Y"); ?> RECAM</h5>
            </div>
        </div>
    </div>
</footer>

</html>