<!DOCTYPE html>
<html>
<?php
include('session_customer.php');
if (!isset($_SESSION['login_customer'])) {
    session_destroy();
    header("location: customerlogin.php");
}
?>
<title>Book camera </title>

<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>

<body ng-app="">


    <!-- Navigation -->
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: bllensak">
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
                                <li><a href="#" class="dropdown-toggle lensative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="cameraet"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="entercamera.php">Tambah kamera</a></li>

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
                        <ul class="nav navbar-nav">
                            <li><a href="#" class="dropdown-toggle lensative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Menu <span class="cameraet"></span> </a>
                                <ul class="dropdown-menu">
                                    <li> <a href="prereturncamera.php">Return Now</a></li>
                                    <li> <a href="mybookings.php"> My Bookings</a></li>
                                </ul>
                            </li>
                        </ul>
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
                <form role="form" action="bookingconfirm.php" method="POST">
                    <br style="clear: both">
                    <br>

                    <?php
                    $camera_id = $_GET["id"];
                    $sql1 = "SELECT * FROM cameras WHERE camera_id = '$camera_id'";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1)) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $camera_name = $row1["camera_name"];
                            $tipe_camera = $row1["tipe_camera"];
                            $lensa_price = $row1["lensa_price"];
                            $tl_price = $row1["tl_price"];
                            $lensa_price_per_day = $row1["lensa_price_per_day"];
                            $tl_price_per_day = $row1["tl_price_per_day"];
                        }
                    }

                    ?>

                    <!-- <div class="form-group"> -->
                    <h5> Kamera yang dipilih:&nbsp; <b><?php echo ($camera_name); ?></b></h5>
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    <?php $today = date("Y-m-d") ?>
                    <label>
                        <h5>Start Date:</h5>
                    </label>
                    <input type="date" name="rent_start_date" min="<?php echo ($today); ?>" required="">
                    &nbsp;
                    <label>
                        <h5>End Date:</h5>
                    </label>
                    <input type="date" name="rent_end_date" min="<?php echo ($today); ?>" required="">
                    <!-- </div>      -->
                    <h5> Pilih tipe kameramu: &nbsp;
                        <input onclick="reveal()" type="radio" name="radio" value="lensa" ng-model="myVar"> <b>Dengan Lensa </b>&nbsp;
                        <input onclick="reveal()" type="radio" name="radio" value="tl" ng-model="myVar"><b>Tanpa Lensa</b>

                        <div ng-switch="myVar">
                            <div ng-switch-default>
                                <!-- <div class="form-group"> -->
                                <h5>Harga: <h5>
                                        <!-- </div>    -->
                            </div>
                            <div ng-switch-when="lensa">
                                <!-- <div class="form-group"> -->
                                <h5>Harga: <b><?php echo ("Rp. " . $lensa_price_per_day . "/hari"); ?></b>
                                    <h5>
                                        <!-- </div>    -->
                            </div>
                            <div ng-switch-when="tl">
                                <!-- <div class="form-group"> -->
                                <h5>Harga: <b><?php echo ("Rp. " . $tl_price_per_day . "/hari"); ?></b>
                                    <h5>
                                        <!-- </div>   -->
                            </div>
                        </div>
                        <h5> Charge type: &nbsp;
                            <input onclick="reveal()" type="radio" name="radio1" value="days"><b> per hari</b>

                            <br><br>

                            <input type="hidden" name="hidden_cameraid" value="<?php echo $camera_id; ?>">
                            <input type="submit" name="submit" value="Rent Now" class="btn btn-warning pull-right">
                </form>
            </div>
            <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                <h6><strong>Note:</strong> Anda akan dikenakan biaya tambahan <span class="text-danger">Rp 10,000</span> per hari setelah tanggal jatuh tempo berakhir.</h6>
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