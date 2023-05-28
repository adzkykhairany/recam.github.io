<!DOCTYPE html>
<html>
<?php
session_start();
require 'connection.php';
$conn = Connect();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recam</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="assets/css/style.css">
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

        @$customer_username = $_POST['customer_username'];
        @$camera_name = $_POST['camera_name'];
        @$number = $_POST['number'];
        @$aduan = $_POST['aduan'];

        if (isset($_POST['send'])) {
            $sql = "insert into aduan(customer_username,camera_name,number,aduan) values('$customer_username','$camera_name','$number','$aduan') ";
            $query = mysqli_query($conn,$sql);
            if($query){
                ?>
                <script>alert('Aduan Telah Dimasukkan!!'); document.location='aduan.php';</script>
                <?php
	}
}

?>


    <section class="contact">

        <form action="" method="post">
            <h3>Ada aduan? Tenang, kami menyediakan form aduan mengenai kamera yang kamu sewa!</h3>
            <input type="text" name="customer_username" placeholder="enter your name" required maxlength="20" class="box">
            <input type="text" name="camera_name" placeholder="tulis nama kameramu" required maxlength="50" class="box">
            <input type="number" name="number" min="0" max="9999999999" placeholder="masukkan kode pesananmu" required onkeypress="if(this.value.length == 10) return false;" class="box">
            <textarea name="aduan" class="box" placeholder="tulis aduanmu" cols="30" rows="10"></textarea>
            <input type="submit" value="Kirim" name="send" class="btn">
        </form>

    </section>
    <h2>

    </h2>




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