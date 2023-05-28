<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="faq/css/reset.css">
    <!-- CSS reset -->
    <link rel="stylesheet" href="faq/css/style.css">
    <!-- Resource style -->
    <script src="faq/js/modernizr.js"></script>
    <!-- Modernizr -->
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="faq/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="faq/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="faq/assets/css/user.css">
    <link rel="stylesheet" href="faq/assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <title>RECAM</title>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-custom" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="../index.php">
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
                            <a href="customerlogin.php">Customer</a>
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

    <section class="cd-ADUAN">
        <ul class="cd-ADUAN-categories">
            <li><a class="selected" href="#basics">Basics</a></li>
            <li><a href="#membership">Membership</a></li>
        </ul>
        <!-- cd-ADUAN-categories -->

        <div class="cd-ADUAN-items">
            <ul id="basics" class="cd-ADUAN-group">
                <li class="cd-ADUAN-title">
                    <h2>Basics</h2>
                </li>
                <li>
                    <a class="cd-ADUAN-trigger" href="#0">How do I pay for my Rental?</a>
                    <div class="cd-ADUAN-content">
                        <p>RECAMs gladly accepts Mastercard and Visa. Personal Checks are also accepted providing you purchase CDW and Theft Protection on your rental.
                            At this time we would like to advise that personal checks are not accepted locally.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>

                <li>
                    <a class="cd-ADUAN-trigger" href="#0">What if i find a better rate for a rental camera?</a>
                    <div class="cd-ADUAN-content">
                        <p>One of the many great things about RECAM is our rental rates and services are guaranteed to be the very best in the industry. If you come across a lower price from a competitor and the rate is on a comparable vehicle including the same terms, locations, and rental camera fees we will be glad to beat the price for you. Please complete our Guaranteed Best Rate form if you have found a better rate with one of our competitors.
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>

                <li>
                    <a class="cd-ADUAN-trigger" href="#0">Will i need a driving license to rent a camera?</a>
                    <div class="cd-ADUAN-content">
                        <p>A driving license is not needed as a driver is already provided by the Staff.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>

                <li>
                    <a class="cd-ADUAN-trigger" href="#0">Is there a fee if i return the camera after the due date?</a>
                    <div class="cd-ADUAN-content">
                        <p>Yes, we charge Rp10,000/- day after the due date.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>
            </ul>
            <!-- cd-ADUAN-group -->

            <ul id="membership" class="cd-ADUAN-group">
                <li class="cd-ADUAN-title">
                    <h2>Membership</h2>
                </li>
                <li>
                    <a class="cd-ADUAN-trigger" href="#0">Why should i sign up?</a>
                    <div class="cd-ADUAN-content">
                        <p>When you sign-up to be a member on our site, you will be able to save time filling out requests. Once you have joined and logged-in, each time you send us a request, we will pre-fill the submission form with your personal information so that you do not have type the same things again and again. We also give you the opportunity to sign-up for our email newsletter which will keep you up-to-date on the latest specials and incentives we're offering.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>

                <li>
                    <a class="cd-ADUAN-trigger" href="#0">How do I become a member?</a>
                    <div class="cd-ADUAN-content">
                        <p>There are two ways to sign-up. You can either go directly to our sign-up form or you can simply complete a request as you normally would. After you send in that request, you will have an opportunity to sign-up. If you choose to do so, when you go to the sign-up form, the information you provided for your request will be pre-filled in the sign-up form.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>
                <li>
                    <a class="cd-ADUAN-trigger" href="#0">How do I login?</a>
                    <div class="cd-ADUAN-content">
                        <p>Once you sign-up, we will re direct you to the log in screen. When you are logged in, you will see a small bar in the upper right corner of the screen welcoming to you our site. If you already have set up an account but have logged out, you can either click on the 'Log-In' button on our menu bar which takes you to our log-in page or, if you are on our HOME page, you can use the log-in area on it.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>
                <li>
                    <a class="cd-ADUAN-trigger" href="#0">What about my privacy?</a>
                    <div class="cd-ADUAN-content">
                        <p>Your privacy is very important to us. As long as you do not share your member name and password with others, no one will be able to see or edit your personal information. For more information, please read our privacy policy.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>
                <li>
                    <a class="cd-ADUAN-trigger" href="#0">What if i share my computer?</a>
                    <div class="cd-ADUAN-content">
                        <p>If you share your computer with others, you should log-out when you are done with your session on our web site. And, when you log-in, make sure that the check-box next to 'Save my password on this computer' is unchecked. Taking these steps will ensure that the next person using the computer will not have access to your account.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>
                <li>
                    <a class="cd-ADUAN-trigger" href="#0">Is my credit card information stored in my account?</a>
                    <div class="cd-ADUAN-content">
                        <p>No.We do not store any credit card information in your account.</p>
                    </div>
                    <!-- cd-ADUAN-content -->
                </li>
            </ul>
            <!-- cd-ADUAN-group -->
            <!-- cd-ADUAN-group -->
        </div>
        <!-- cd-ADUAN-items -->
        <a href="#0" class="cd-close-panel">Close</a>
    </section>
    <!-- cd-ADUAN -->
    <script src="faq/js/jquery-2.1.1.js"></script>
    <script src="faq/faq/js/jquery.mobile.custom.min.js"></script>
    <script src="faq/js/main.js"></script>
    <!-- Resource jQuery -->
</body>

</html>