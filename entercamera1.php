<html>

<head>
    <title> customer Signup | RECAM </title>
</head>
<?php session_start(); ?>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">

<link rel="stylesheet" href="assets/w3css/w3.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

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

    <?php

    require 'connection.php';
    $conn = Connect();

    function GetImageExtension($imagetype)
    {
        if (empty($imagetype)) return false;

        switch ($imagetype) {
            case 'assets/img/cameras/bmp':
                return '.bmp';
            case 'assets/img/cameras/gif':
                return '.gif';
            case 'assets/img/cameras/jpeg':
                return '.jpg';
            case 'assets/img/cameras/png':
                return '.png';
            default:
                return false;
        }
    }

    $camera_name = $conn->real_escape_string($_POST['camera_name']);
    $tipe_camera = $conn->real_escape_string($_POST['tipe_camera']);
    $lensa_price_per_day = $conn->real_escape_string($_POST['lensa_price_per_day']);
    $tl_price_per_day = $conn->real_escape_string($_POST['tl_price_per_day']);
    $camera_availability = "yes";

    //$query = "INSERT into cameras(camera_name,,ac_price,non_ac_price,camera_availability) VALUES('" . $camera_name . "','" . $camera_nameplate . "','" . $ac_price . "','" . $non_ac_price . "','" . $camera_availability ."')";
    //$success = $conn->query($query);


    if (!empty($_FILES["uploadedimage"]["name"])) {
        $file_name = $_FILES["uploadedimage"]["name"];
        $temp_name = $_FILES["uploadedimage"]["tmp_name"];
        $imgtype = $_FILES["uploadedimage"]["type"];
        $ext = GetImageExtension($imgtype);
        $imagename = $_FILES["uploadedimage"]["name"];
        $target_path = "assets/img/cameras/" . $imagename;

        if (move_uploaded_file($temp_name, $target_path)) {
            //$query0="INSERT into cameras (camera_img) VALUES ('".$target_path."')";
            //  $query0 = "UPDATE cameras SET camera_img = '$target_path' WHERE ";
            //$success0 = $conn->query($query0);

            $query = "INSERT into cameras(camera_name,tipe_camera,camera_img,lensa_price_per_day,tl_price_per_day,camera_availability) 
            VALUES('" . $camera_name . "','" . $tipe_camera . "','" . $target_path . "','" . $lensa_price_per_day . "','" . $tl_price_per_day . "','" . $camera_availability . "')";
            $success = $conn->query($query);
        }
    }


    // Taking camera_id from cameras

    $query1 = "SELECT camera_id from cameras where camera_name = '$camera_name'";

    $result = mysqli_query($conn, $query1);
    $rs = mysqli_fetch_array($result, MYSQLI_BOTH);
    $camera_id = $rs['camera_id'];


    $query2 = "INSERT into clientcameras(camera_id,client_username) values('" . $camera_id . "','" . $_SESSION['login_client'] . "')";
    $success2 = $conn->query($query2);

    if (!$success) { ?>
        <div class="container">
            <div class="jumbotron" style="text-align: center;">
                camera already exists!
                <?php echo $conn->error; ?>
                <br><br>
                <a href="entercamera.php" class="btn btn-default"> Go Back </a>
            </div>
        <?php
    } else {
        header("location: entercamera.php"); //Redirecting 
    }

    $conn->close();

        ?>

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