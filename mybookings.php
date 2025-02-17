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
                                        <li> <a href="enterdriver.php"> Sofőr hozzáadása</a></li>
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
                                    <li> <a href="prereturncar.php">Visszaadás most</a></li>
                                    <li> <a href="mybookings.php">Foglalási Előzmények</a></li>
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
                            <a href="#"> GYIK </a>
                        </li>
                    </ul>
                </div>
            <?php } ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php $login_customer = $_SESSION['login_customer'];

    $sql1 = "SELECT * FROM rentedcars rc, cars c
    WHERE rc.customer_username='$login_customer' AND c.car_id=rc.car_id AND rc.return_status='R'";
    $result1 = $conn->query($sql1);

    if (mysqli_num_rows($result1) > 0) {
    ?>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Foglalási Előzmények</h1>
                <p class="text-center">Reméljük, hogy elégedett a szolgáltatásainkkal!</p>
            </div>
        </div>

        <div class="table-responsive" style="padding-left: 100px; padding-right: 100px; max-width: 1300px; margin: 0 auto;">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th width="15%">Autó</th>
                        <th width="15%">Kezdeti dátum</th>
                        <th width="15%">Visszaadási dátum</th>
                        <th width="10%">Díj</th>
                        <th width="15%">Távolság (km)</th>
                        <th width="15%">Napok száma</th>
                        <th width="15%" style="text-align: right">Teljes összeg</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($result1)) {
                ?>
                    <tr>
                        <td><?php echo $row["car_name"]; ?></td>
                        <td><?php echo $row["rent_start_date"] ?></td>
                        <td><?php echo $row["rent_end_date"]; ?></td>
                        <td> <?php
                                if ($row["charge_type"] == "days") {
                                    echo ($row["fare"] . " Ft /nap");
                                } else {
                                    echo ($row["fare"] . " Ft /km");
                                }
                                ?></td>
                        <td><?php  if ($row["charge_type"] == "days") {
                                    echo ("Nincs megadva (Napi bérlés)");
                                } else {
                                    echo ($row["distance"]);
                                } ?></td>
                        <td><?php echo $row["no_of_days"]; ?> </td>
                        <td style="text-align: right"> <?php echo $row["total_amount"]; ?> Ft</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } else {
    ?>
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Még nem bérelt autót!</h1>
                <p class="text-center"> Kérem béreljen autót, hogy láthassa az adatait itt. </p>
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
                <h5>© <?php echo date("Y"); ?> Autókölcsönző</h5>
            </div>
        </div>
    </div>
</footer>

</html>
