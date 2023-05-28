<!DOCTYPE html>
<html>

<?php
include('session_client.php'); ?>

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
              <a href="#"><span class="glyphicon glyphicon-user"></span>Halo <?php echo $_SESSION['login_client']; ?></a>
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
        <form role="form" action="entercamera1.php" enctype="multipart/form-data" method="POST">
          <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Masukkan detail kamera </h3>

          <div class="form-group">
            <input type="text" class="form-control" id="camera_name" name="camera_name" placeholder="nama kamera " required autofocus="">
          </div>
          <div class="form-group">
            <select name="tipe_camera" class="form-control" id="tipe_camera" required>
              <option value="tipekamera">--tipe kamera--</option>
              <option value="dslr">DSLR</option>
              <option value="mirrorless">Mirrorless</option>
              <option value="poket">Poket</option>
              <option value="ac">Action Cam</option>
            </select>

          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="lensa_price_per_day" name="lensa_price_per_day" placeholder="Harga lensa per hari (Rp)" required>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="tl_price_per_day" name="tl_price_per_day" placeholder="Harga tanpa lensa per hari (Rp)" required>
          </div>

          <div class="form-group">
            <input name="uploadedimage" type="file">
          </div>
          <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Sewakan</button>
        </form>
      </div>
    </div>


    <div class="col-md-12" style="float: none; margin: 0 auto;">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="" method="POST">
          <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> My cameras </h3>
          <?php
          // Storing Session
          $user_check = $_SESSION['login_client'];
          $sql = "SELECT * FROM cameras WHERE camera_id IN (SELECT camera_id FROM clientcameras WHERE client_username='$user_check');";
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
          ?>
            <div style="overflow-x:auto;">
              <table class="table table-striped">
                <thead class="thead-dark">
                  <tr>
                    <th></th>
                    <th width="24%"> Nama</th>
                    <th width="15%"> Tipe Kamera</th>
                    <th width="17%"> Dengan Lensa (/hari)</th>
                    <th width="17%"> Tanpa Lensa (/hari)</th>
                    <th width="1%"> Status </th>
                  </tr>
                </thead>

                <?PHP
                //OUTPUT DATA OF EACH ROW
                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                  <tbody>
                    <tr>
                      <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
                      <td><?php echo $row["camera_name"]; ?></td>
                      <td><?php echo $row["tipe_camera"]; ?></td>
                      <td><?php echo $row["lensa_price_per_day"]; ?></td>
                      <td><?php echo $row["tl_price_per_day"]; ?></td>
                      <td><?php echo $row["camera_availability"]; ?></td>
                      <td><?php echo "<a href='update.php?id=$row[camera_id]'>Ubah</a> | <a href ='delete.php?id-
                $row[camera_id]'>Hapus</a> "; ?></td>


                    </tr>
                  </tbody>
                <?php } ?>
              </table>
            </div>
            <br>
          <?php } else { ?>
            <h4>
              <center>0 cameras available</center>
            </h4>
          <?php } ?>
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