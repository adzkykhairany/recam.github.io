<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
                                        <li> <a href="entercamera.php">Tambah kamera</a></li>

                                        <li> <a href="clientview.php">View</a></li>

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
                            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Menu <span class="cameraet"></span> </a>
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

    <body>

        <?php
        $id = $_GET["id"];
        $fare = $_POST['fare'];

        $camera_return_date = date('Y-m-d');
        $return_status = "R";
        $login_customer = $_SESSION['login_customer'];

        $sql0 = "SELECT rc.id, rc.rent_end_date, rc.charge_type, rc.rent_start_date, c.camera_name FROM rentedcameras rc, cameras c WHERE id = '$id' AND c.camera_id = rc.camera_id";
        $result0 = $conn->query($sql0);

        if (mysqli_num_rows($result0) > 0) {
            while ($row0 = mysqli_fetch_assoc($result0)) {
                $rent_end_date = $row0["rent_end_date"];
                $rent_start_date = $row0["rent_start_date"];
                $camera_name = $row0["camera_name"];
                $charge_type = $row0["charge_type"];
            }
        }

        function dateDiff($start, $end)
        {
            $start_ts = strtotime($start);
            $end_ts = strtotime($end);
            $diff = $end_ts - $start_ts;
            return round($diff / 86400);
        }

        $extra_days = dateDiff("$rent_end_date", "$camera_return_date");
        $total_fine = $extra_days * 10000;
        @$total_amount = $fare * $no_of_days;
        $duration = dateDiff("$rent_start_date", "$rent_end_date");

        if ($extra_days > 0) {
            $total_amount = $total_amount + $total_fine;
        }

        if ($charge_type == "days") {
            $no_of_days = $extra_days + $duration;
            $sql1 = "UPDATE rentedcameras SET camera_return_date='$camera_return_date',  no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
        } else {
            $distance_or_days = $no_of_days;
            $sql1 = "UPDATE rentedcameras SET camera_return_date='$camera_return_date', no_of_days='$duration', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
        }


        $result1 = $conn->query($sql1);

        if ($result1) {
            $sql2 = "UPDATE cameras c, rentedcameras rc SET c.camera_availability='yes' 
     WHERE rc.camera_id=c.camera_id AND rc.customer_username = '$login_customer' AND rc.id = '$id'";
            $result2 = $conn->query($sql2);
        } else {
            echo $conn->error;
        }
        ?>

        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> camera Returned</h1>
            </div>
        </div>
        <br>

        <h2 class="text-center"> Terima Kasih telah menggunakan jasa rental kamera kami! Have a good photos! </h2>

        <h3 class="text-center"> <strong>Nomor pesanan Anda:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


        <div class="container">
            <h5 class="text-center">Silakan baca informasi berikut tentang pesanan Anda.</h5>
            <div class="box">
                <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                    <h3 style="color: orange;">Pemesanan Anda telah diterima dan dimasukkan ke dalam sistem pemrosesan pesanan.</h3>
                    <br>
                    <h4>Harap catat <strong>nomor pesanan</strong> Anda sekarang dan simpan jika Anda perlu berkomunikasi dengan kami tentang pesanan Anda.</h4> <br>
                    <h3 style="color: orange;">Invoice</h3>
                    <br>
                </div>
                <div class="col-md-10" style="float: none; margin: 0 auto; ">
                    <h4> <strong>Fare:&nbsp;</strong> Rp. <?php
                                                            if ($charge_type == "days") {
                                                                echo ($fare . "/day");
                                                            }
                                                            ?></h4>
                    <br>
                    <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                    <br>
                    <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                    <br>
                    <h4> <strong>Rent End Date: </strong> <?php echo $rent_end_date; ?></h4>
                    <br>
                    <h4> <strong>Camera Return Date: </strong> <?php echo $camera_return_date; ?> </h4>
                    <br>
                    <?php if ($charge_type == "days") { ?>
                        <h4> <strong>Number of days:</strong> <?php echo $no_of_days; ?>day(s)</h4>
                    <?php } else {
                        return false;
                    } ?>

                    <br>
                    <?php
                    if ($extra_days > 0) {

                    ?>
                        <h4> <strong>Total Fine:</strong> <label class="text-danger"> Rp. <?php echo $total_fine; ?>/- </label> for <?php echo $extra_days; ?> extra days.</h4>
                        <br>
                    <?php } ?>
                    <h4> <strong>Total Tagihan: </strong> Rp. <?php echo $total_amount; ?>/- </h4>
                    <br>
                </div>
            </div>
            <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                <h6>Warning! <strong>Jangan reload halaman ini </strong> atau tampilan di atas akan hilang. Jika Anda ingin hardcopy halaman ini, silakan cetak sekarang.</h6>
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