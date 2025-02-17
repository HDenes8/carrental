<!DOCTYPE html>
<html>

<head>
    <title> Ügyfél Regisztráció | C-rental Hungary </title>
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
</head>

<link rel="stylesheet" type="text/css" href="assets/css/manager_registered_success.css">
<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<body>

    <!--Vissza a lap tetejére gomb..................................................................................-->
    <button onclick="topFunction()" id="myBtn" title="Ugrás az oldal tetejére">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
    <!--JavaScript a vissza a lap tetejére gombhoz....................................................................-->
    <script type="text/javascript">
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

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
            <!-- A navigáció gombjai, űrlapok és más tartalom gyűjtése a kinyíló menühöz -->

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
                                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Irányítópult <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="entercar.php">Autó hozzáadása</a></li>
                                        <li> <a href="enterdriver.php"> Sofőr hozzáadása</a></li>
                                        <li> <a href="clientview.php">Nézet</a></li>

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
                                    <li> <a href="mybookings.php"> Saját foglalásaim</a></li>
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
            <?php   }
            ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <?php

    require 'connection.php';
    $conn = Connect();

    $client_name = $conn->real_escape_string($_POST['client_name']);
    $client_username = $conn->real_escape_string($_POST['client_username']);
    $client_email = $conn->real_escape_string($_POST['client_email']);
    $client_phone = $conn->real_escape_string($_POST['client_phone']);
    $client_address = $conn->real_escape_string($_POST['client_address']);
    $client_password = $conn->real_escape_string($_POST['client_password']);

    $query = "INSERT into clients(client_name,client_username,client_email,client_phone,client_address,client_password) VALUES('" . $client_name . "','" . $client_username . "','" . $client_email . "','" . $client_phone . "','" . $client_address . "','" . $client_password . "')";
    $success = $conn->query($query);

    if (!$success) {
        die("Nem sikerült az adatok rögzítése: " . $conn->error);
    }

    $conn->close();

    ?>


    <div class="container">
        <div class="jumbotron" style="text-align: center;">
            <h2> <?php echo "Üdvözöljük, $client_name!" ?> </h2>
            <h1>A fiókja elkészült.</h1>
            <p>Most jelentkezzen be innen <a href="clientlogin.php">IDE</a></p>
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
