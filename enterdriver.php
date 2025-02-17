<!DOCTYPE html>
<html>

<?php
include('session_client.php');
?>

<head>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>

<body>
    <!-- Navigáció -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    C-rental Hungary </a>
            </div>
            <!-- Navigációs linkek, űrlapok és egyéb tartalmak gyűjtése a lenyílóhoz -->

            <?php
            if (isset($_SESSION['login_client'])) {
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Kezdőlap</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözöljük <?php echo $_SESSION['login_client']; ?></a>
                        </li>
                        <li>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Vezérlőpult <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="entercar.php">Autó hozzáadása</a></li>
                                        <li> <a href="enterdriver.php"> Sofőr hozzáadása</a></li>
                                        <li> <a href="clientview.php">Foglalási Előzmények</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Kijelentkezés</a>
                        </li>
                    </ul>
                </div>

            <?php
            } else if (isset($_SESSION['login_customer'])) {
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Kezdőlap</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözöljük <?php echo $_SESSION['login_customer']; ?></a>
                        </li>
                        <li>
                            <a href="#">Előzmények</a>
                        </li>
                        <li>
                            <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Kijelentkezés</a>
                        </li>
                    </ul>
                </div>

            <?php
            } else {
            ?>

                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Kezdőlap</a>
                        </li>
                        <li>
                            <a href="clientlogin.php">Munkatárs</a>
                        </li>
                        <li>
                            <a href="customerlogin.php">Ügyfél</a>
                        </li>
                        <li>
                            <a href="#"> FAQ </a>
                        </li>
                    </ul>
                </div>
            <?php
            }
            ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="enterdriver1.php" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Írja be a sofőr adatait </h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Sofőr neve" required autofocus="">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="dl_number" name="dl_number" placeholder="Jogosítvány száma" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="driver_phone" name="driver_phone" placeholder="Telefonszám" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="driver_address" name="driver_address" placeholder="Cím" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="driver_gender" name="driver_gender" placeholder="Nem" required>
                    </div>

                    <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right"> Sofőr hozzáadása</button>
                </form>
            </div>
        </div>
        <div class="col-md-9" style="float: none; margin: 0 auto;">
            <div class="form-area" style="padding: 0px 100px 100px 100px;">
                <form action="" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Az én sofőrjeim </h3>
                    <?php
                    // Session tárolása
                    $user_check = $_SESSION['login_client'];
                    $sql = "SELECT * FROM driver d WHERE d.client_username='$user_check' ORDER BY driver_name";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    ?>

                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th> </th>
                                    <th> Név</th>
                                    <th> Nem </th>
                                    <th> Jogosítvány száma </th>
                                    <th> Telefonszám </th>
                                    <th> Cím </th>
                                    <th> Elérhetőség </th>
                                </tr>
                            </thead>

                            <?PHP
                            // MINDEN SOR ADATAINAK KIÍRATÁSA
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>

                                <tbody>
                                    <tr>
                                        <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
                                        <td><?php echo $row["driver_name"]; ?></td>
                                        <td><?php echo $row["driver_gender"]; ?></td>
                                        <td><?php echo $row["dl_number"]; ?></td>
                                        <td><?php echo $row["driver_phone"]; ?></td>
                                        <td><?php echo $row["driver_address"]; ?></td>
                                        <td><?php echo $row["driver_availability"]; ?></td>

                                    </tr>
                                </tbody>

                    <?php }
                    ?>
                        </table>
                        <br>

                    <?php } else { ?>

                        <h4><center>0 elérhető sofőr</center> </h4>

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
                <h5>© <?php echo date("Y"); ?> C-rental Hungary</h5>
            </div>
        </div>
    </div>
</footer>

</html>
