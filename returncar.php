<!DOCTYPE html>
<html>

<?php
session_start();
require 'connection.php';
$conn = Connect();
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

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
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
            <!-- Menüpontok, űrlapok és más tartalmak gyűjtése a be- és kikapcsoláshoz -->

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
                                        <li> <a href="enterdriver.php">Sofőr hozzáadása</a></li>
                                        <li> <a href="clientview.php">Megtekintés</a></li>
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
                        <ul class="nav navbar-nav">
                            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garázs <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li> <a href="returncar.php">Visszaadás most</a></li>
                                    <li> <a href="mybookings.php">Saját foglalások</a></li>
                                </ul>
                            </li>
                        </ul>
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
                            <a href="#">GYIK</a>
                        </li>
                    </ul>
                </div>
            <?php } ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php
    function dateDiff($start, $end)
    {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    $id = $_GET["id"];
    $sql1 = "SELECT c.car_name, c.car_nameplate, rc.rent_start_date, rc.rent_end_date, rc.fare, rc.charge_type, d.driver_name, d.driver_phone
 FROM rentedcars rc, cars c, driver d
 WHERE id = '$id' AND c.car_id=rc.car_id AND d.driver_id = rc.driver_id";
    $result1 = $conn->query($sql1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $car_name = $row["car_name"];
            $car_nameplate = $row["car_nameplate"];
            $driver_name = $row["driver_name"];
            $driver_phone = $row["driver_phone"];
            $rent_start_date = $row["rent_start_date"];
            $rent_end_date = $row["rent_end_date"];
            $fare = $row["fare"];
            $charge_type = $row["charge_type"];
            $no_of_days = dateDiff("$rent_start_date", "$rent_end_date");
        }
    }
    ?>
    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="printbill.php?id=<?php echo $id ?>" method="POST">
                    <br style="clear: both">
                    <h3 style="margin-bottom: 5px; text-align: center; font-size: 30px;"> Útvonal részletei </h3>
                    <h6 style="margin-bottom: 25px; text-align: center; font-size: 12px;"> Engedje meg sofőrjének, hogy töltse ki az alábbi űrlapot </h6>

                    <h5> Autó:&nbsp; <?php echo ($car_name); ?></h5>

                    <h5> Járműszám:&nbsp; <?php echo ($car_nameplate); ?></h5>

                    <h5> Bérleti dátum:&nbsp; <?php echo ($rent_start_date); ?></h5>

                    <h5> Visszatérés dátuma:&nbsp; <?php echo ($rent_end_date); ?></h5>

                    <h5> Ár:&nbsp;  <?php
                                        if ($charge_type == "days") {
                                            echo ($fare . " Ft /nap");
                                        } else {
                                            echo ($fare . " Ft /km");
                                        }
                                        ?>
                    </h5>

                    <h5> Sofőr neve:&nbsp; <?php echo ($driver_name); ?></h5>

                    <h5> Sofőr kapcsolata:&nbsp; <?php echo ($driver_phone); ?></h5>
                    <?php if ($charge_type == "km") { ?>
                        <div class="form-group">
                            <input type="text" class="form-control" id="distance_or_days" name="distance_or_days" placeholder="Adja meg az megtett távolságot (km-ben)" required="" autofocus>
                        </div>
                    <?php } else { ?>
                        <h5> Nap(ok) száma:&nbsp; <?php echo ($no_of_days); ?></h5>
                        <input type="hidden" name="distance_or_days" value="<?php echo $no_of_days; ?>">
                    <?php } ?>
                    <input type="hidden" name="hid_fare" value="<?php echo $fare; ?>">

                    <input type="submit" name="submit" value="beküldés" class="btn btn-success pull-right">
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
