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

    <?php $login_customer = $_SESSION['login_customer'];

    $sql1 = "SELECT * FROM rentedcameras rc, cameras c
    WHERE rc.customer_username='$login_customer' AND c.camera_id=rc.camera_id AND rc.return_status='R'";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
    ?>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Pesanan anda</h1>
                <p class="text-center"> Hope you enjoyed our service </p>
            </div>
        </div>

        <div class="table-responsive" style="padding-left: 100px; padding-right: 100px;">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="15%">Kamera</th>
                        <th width="15%">Start Date</th>
                        <th width="15%">End Date</th>
                        <th width="10%">Fare</th>
                        <th width="15%">Number of Days</th>
                        <th width="15%">Total Harga</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($result1)) {
                ?>
                    <tr>
                        <td><?php echo $row["camera_name"]; ?></td>
                        <td><?php echo $row["rent_start_date"] ?></td>
                        <td><?php echo $row["rent_end_date"]; ?></td>
                        <td>Rp. <?php
                                if ($row["charge_type"] == "days") {
                                    echo ($row["fare"] . "/day");
                                }
                                ?></td>
                        <td><?php echo $row["no_of_days"]; ?> </td>
                        <td>Rp. <?php echo $row["total_amount"]; ?></td>
                    </tr>
                <?php        } ?>
            </table>
        </div>
    <?php } else {

    ?>
        <div class="container">
            <div class="jumbotron">
                <h2 class="text-center"><b>Anda belum menyewa kamera apapun sampai sekarang!</b></h2>
                <p class="text-center"> Silakan sewa kamera untuk melihat data Anda di sini. </p>
            </div>
        </div>

    <?php
    } ?>

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