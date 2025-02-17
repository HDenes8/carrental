<?php
include('login_customer.php'); // Bejelentkezési szkript beillesztése

if(isset($_SESSION['login_customer'])){
header("location: index.php"); // Átirányítás
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> Ügyfél Bejelentkezés | C-rental Hungary </title>
</head>
<link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
<link rel="stylesheet" type="text/css" href="assets/css/customerlogin.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="assets/w3css/w3.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

<body background="assets/img/blank.png">
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
            <!-- Navigációs linkek, űrlapok és más tartalmak összegyűjtése -->

            <?php
            if(isset($_SESSION['login_client'])){
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
                                    <li> <a href="entercar.php">Autó Hozzáadása</a></li>
                                    <li> <a href="enterdriver.php"> Sofőr Hozzáadása</a></li>
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
            }
            else if (isset($_SESSION['login_customer'])){
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
            }
            else {
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
                        <a href="faq/index.php"> GYIK </a>
                    </li>
                </ul>
            </div>
            <?php   }
            ?>
            <!-- Navigációs sáv lezárása -->
        </div>
        <!-- Tartalomtár lezárása -->
    </nav>

    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">C-rental Hungary - Ügyfél Panel</span>
            </h1>
            <br>
            <p class="text-center">Kérjük, jelentkezzen be a folytatáshoz.</p>
        </div>
    </div>

    <div class="container" style="margin-top: -2%; margin-bottom: 2%;">
        <div class="col-md-5 col-md-offset-4">
            <label style="margin-left: 5px;color: red;"><span> <?php echo $error;  ?> </span></label>
            <div class="panel panel-primary">
                <div class="panel-heading"> Bejelentkezés </div>
                <div class="panel-body">

                    <form action="" method="POST">

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_username"><span class="text-danger" style="margin-right: 5px;">*</span> Felhasználónév: </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_username" type="text" name="customer_username" placeholder="Felhasználónév" required="" autofocus="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></label>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <label for="customer_password"><span class="text-danger" style="margin-right: 5px;">*</span> Jelszó: </label>
                                <div class="input-group">
                                    <input class="form-control" id="customer_password" type="password" name="customer_password" placeholder="Jelszó" required="">
                                    <span class="input-group-btn">
                                        <label class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></label>
                                    </span>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-4">
                                <button class="btn btn-primary" name="submit" type="submit" value=" Bejelentkezés ">Bejelentkezés</button>

                            </div>

                        </div>
                        <label style="margin-left: 5px;">vagy</label> <br>
                        <label style="margin-left: 5px;"><a href="customersignup.php">Új fiók létrehozása.</a></label>
                    </form>
                </div>
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
