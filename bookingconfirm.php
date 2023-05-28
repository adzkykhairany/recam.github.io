<!DOCTYPE html>
<html>

<?php
include('session_customer.php');
if (!isset($_SESSION['login_customer'])) {
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body>

    <?php

    $type = $_POST['radio'];
    $charge_type = $_POST['radio1'];
    $customer_username = $_SESSION["login_customer"];
    $camera_id = $conn->real_escape_string($_POST['hidden_cameraid']);
    $rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $return_status = "NR"; // not returned
    $fare = "NA";

    


    function dateDiff($start, $end)
    {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }

    $err_date = dateDiff("$rent_start_date", "$rent_end_date");

    $sql0 = "SELECT * FROM cameras WHERE camera_id = '$camera_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while ($row0 = mysqli_fetch_assoc($result0)) {
            if ($type == "lensa" && $charge_type == "days") {
                $fare = $row0["lensa_price_per_day"];
            } else if ($type == "tl" && $charge_type == "days") {
                $fare = $row0["tl_price_per_day"];
            } else {
                $fare = "NA";
            }
        }
    }
    if ($err_date >= 0) {
        $sql1 = "INSERT into rentedcameras(customer_username,camera_id,booking_date,rent_start_date,rent_end_date,fare,charge_type,return_status) 
        VALUES('" . $customer_username . "','" . $camera_id . "','" . date("Y-m-d") . "','" . $rent_start_date . "','" . $rent_end_date . "','" . $fare . "','" . $charge_type . "','" . $return_status . "')";
        $result1 = $conn->query($sql1);

        $sql2 = "UPDATE cameras SET camera_availability = 'no' WHERE camera_id = '$camera_id'";
        $result2 = $conn->query($sql2);

        $sql4 = "SELECT * FROM  cameras c, clients cl, rentedcameras rc WHERE c.camera_id = '$camera_id'";
        $result4 = $conn->query($sql4);


        if (mysqli_num_rows($result4) > 0) {
            while ($row = mysqli_fetch_assoc($result4)) {
                $id = $row["id"];
                $camera_name = $row["camera_name"];
                $tipe_camera = $row["tipe_camera"];
            }
        }

        if (!$result1 | !$result2) {
            die("Couldnt enter data: " . $conn->error);
        }

    ?>
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
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>Pemesanan Dikonfirmasi.</h1>
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
                    <h4>Harap catat <strong>nomor pesanan</strong> Anda sekarang dan simpan jika Anda perlu berkomunikasi dengan kami tentang pesanan Anda.</h4>
                    <br>
                    <h3 style="color: orange;">Invoice</h3>
                    <br>
                </div>
                <div class="col-md-10" style="float: none; margin: 0 auto; ">
                    <h4> <strong>Nama Kamera: </strong> <?php echo $camera_name; ?></h4>
                    <br>

                    <?php
                    if ($charge_type == "days") {
                    ?>
                        <h4> <strong>Harga:</strong> Rp. <?php echo $fare; ?>/hari</h4>
                    <?php } ?>

                    <br>
                    <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-d"); ?> </h4>
                    <br>
                    <h4> <strong>Start Date: </strong> <?php echo $rent_start_date; ?></h4>
                    <br>
                    <h4> <strong>Return Date: </strong> <?php echo $rent_end_date; ?></h4>
                    <br>
                    <h4> <strong>Total Harga: </strong> <?php echo $total_amount; ?></h4>
                    <br>
                    <h5>Jika ada keluhan pada kamera, silakan segera hubungi Kami pada halaman MyBookings.</h5>
                </div>
            </div>
            <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                <h6>Warning! <strong>Jangan reload halaman ini </strong> atau tampilan di atas akan hilang. Jika Anda ingin hardcopy halaman ini, silakan cetak sekarang.</h6>
            </div>
        </div>
</body>
<?php } else { ?>
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
    <div class="container">
        <div class="jumbotron" style="text-align: center;">
            Anda telah memilih tanggal yang salah.
            <br><br>
        </div>
    <?php } ?>
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