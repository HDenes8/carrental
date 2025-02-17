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
    <link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
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
                    Autókölcsönző </a>
            </div>
            <!-- Navigációs menü, űrlapok és más tartalom összegyűjtése az átváltáshoz -->

            <?php
            if (isset($_SESSION['login_client'])) {
            ?>
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Kezdőlap</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözlünk <?php echo $_SESSION['login_client']; ?></a>
                        </li>
                        <li>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Vezérlőpult <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="entercar.php">Autó hozzáadása</a></li>
                                        <li> <a href="enterdriver.php">Sofőr hozzáadása</a></li>
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
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözlünk <?php echo $_SESSION['login_customer']; ?></a>
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
                            <a href="clientlogin.php">Alkalmazott</a>
                        </li>
                        <li>
                            <a href="customerlogin.php">Ügyfél</a>
                        </li>
                        <li>
                            <a href="#"> GYIK </a>
                        </li>
                    </ul>
                </div>
            <?php } ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.tartalom -->
    </nav>

    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="entercar1.php" enctype="multipart/form-data" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Kérjük, adja meg az autó részleteit. </h3>

                    <div class="form-group">
                        <input type="text" class="form-control" id="car_name" name="car_name" placeholder="Autó neve" required autofocus="">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="car_nameplate" name="car_nameplate" placeholder="Rendszáma" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="ac_price" name="ac_price" placeholder="AC díj per KM (Ft)" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="non_ac_price" name="non_ac_price" placeholder="Non-AC díj per KM (Ft)" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="ac_price_per_day" name="ac_price_per_day" placeholder="AC díj naponta (Ft)" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="non_ac_price_per_day" name="non_ac_price_per_day" placeholder="Non-AC díj naponta (Ft)" required>
                    </div>

                    <div class="form-group">
                        <input name="uploadedimage" type="file">
                    </div>
                    <button type="submit" id="submit" name="submit" class="btn btn-success pull-right"> Jármű adatainak benyújtása</button>
                </form>
            </div>
        </div>

        <div class="col-md-12" style="float: none; margin: 0 auto;">
            <div class="form-area" style="padding: 0px 100px 100px 100px;">
                <form action="" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Az én autóim </h3>
                    <?php
                    // Session tárolása
                    $user_check = $_SESSION['login_client'];
                    $sql = "SELECT * FROM cars WHERE car_id IN (SELECT car_id FROM clientcars WHERE client_username='$user_check');";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <div style="overflow-x:auto;">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>
                                        <th width="24%"> Név</th>
                                        <th width="15%"> Rendszám </th>
                                        <th width="13%"> AC díj (/km) </th>
                                        <th width="17%"> Non-AC díj (/km)</th>
                                        <th width="13%"> AC díj (/nap)</th>
                                        <th width="17%"> Non-AC díj (/nap)</th>
                                        <th width="1%"> Elérhetőség </th>
                                    </tr>
                                </thead>

                                <?php
                                // Minden sor adatainak kimenete
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>

                                    <tbody>
                                        <tr>
                                            <td> <span class="glyphicon glyphicon-menu-right"></span> </td>
                                            <td><?php echo $row["car_name"]; ?></td>
                                            <td><?php echo $row["car_nameplate"]; ?></td>
                                            <td><?php echo $row["ac_price"]; ?></td>
                                            <td><?php echo $row["non_ac_price"]; ?></td>
                                            <td><?php echo $row["ac_price_per_day"]; ?></td>
                                            <td><?php echo $row["non_ac_price_per_day"]; ?></td>
                                            <td><?php echo $row["car_availability"]; ?></td>

                                        </tr>
                                    </tbody>
                                <?php } ?>
                            </table>
                        </div>
                        <br>
                    <?php } else { ?>
                        <h4><center>0 elérhető autó</center> </h4>
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
                <h5>© <?php echo date("Y"); ?> Autókölcsönző</h5>
            </div>
        </div>
    </div>
</footer>

</html>
