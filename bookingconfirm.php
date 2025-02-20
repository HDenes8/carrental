<!DOCTYPE html>
<html>

<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
</head>

<body>

<?php


    $type = $_POST['radio'];
    $charge_type = $_POST['radio1'];
    $driver_id = $_POST['driver_id_from_dropdown'];
    $customer_username = $_SESSION["login_customer"];
    $car_id = $conn->real_escape_string($_POST['hidden_carid']);
    $rent_start_date = date('Y-m-d', strtotime($_POST['rent_start_date']));
    $rent_end_date = date('Y-m-d', strtotime($_POST['rent_end_date']));
    $return_status = "NR"; // not returned
    $fare = "NA";


    function dateDiff($start, $end) {
        $start_ts = strtotime($start);
        $end_ts = strtotime($end);
        $diff = $end_ts - $start_ts;
        return round($diff / 86400);
    }
    
    $err_date = dateDiff("$rent_start_date", "$rent_end_date");

    $sql0 = "SELECT * FROM cars WHERE car_id = '$car_id'";
    $result0 = $conn->query($sql0);

    if (mysqli_num_rows($result0) > 0) {
        while($row0 = mysqli_fetch_assoc($result0)) {

            if($type == "ac" && $charge_type == "km"){
                $fare = $row0["ac_price"];
            } else if ($type == "ac" && $charge_type == "days"){
                $fare = $row0["ac_price_per_day"];
            } else if ($type == "non_ac" && $charge_type == "km"){
                $fare = $row0["non_ac_price"];
            } else if ($type == "non_ac" && $charge_type == "days"){
                $fare = $row0["non_ac_price_per_day"];
            } else {
                $fare = "NA";
            }
        }
    }
    if($err_date >= 0) { 
    $sql1 = "INSERT into rentedcars(customer_username,car_id,driver_id,booking_date,rent_start_date,rent_end_date,fare,charge_type,return_status) 
    VALUES('" . $customer_username . "','" . $car_id . "','" . $driver_id . "','" . date("Y-m-d") ."','" . $rent_start_date ."','" . $rent_end_date . "','" . $fare . "','" . $charge_type . "','" . $return_status . "')";
    $result1 = $conn->query($sql1);

    $sql2 = "UPDATE cars SET car_availability = 'no' WHERE car_id = '$car_id'";
    $result2 = $conn->query($sql2);

    $sql3 = "UPDATE driver SET driver_availability = 'no' WHERE driver_id = '$driver_id'";
    $result3 = $conn->query($sql3);

    $sql4 = "SELECT * FROM  cars c, clients cl, driver d, rentedcars rc WHERE c.car_id = '$car_id' AND d.driver_id = '$driver_id' AND cl.client_username = d.client_username";
    $result4 = $conn->query($sql4);


    if (mysqli_num_rows($result4) > 0) {
        while($row = mysqli_fetch_assoc($result4)) {
            $id = $row["id"];
            $car_name = $row["car_name"];
            $car_nameplate = $row["car_nameplate"];
            $driver_name = $row["driver_name"];
            $driver_gender = $row["driver_gender"];
            $dl_number = $row["dl_number"];
            $driver_phone = $row["driver_phone"];
            $client_name = $row["client_name"];
            $client_phone = $row["client_phone"];
        }
    }

    if (!$result1 | !$result2 | !$result3){
        die("Nem sikerült rögzíteni az adatokat: ".$conn->error);
    }

?>
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
            <!-- Gyűjtse össze a navigációs linkeket, űrlapokat és egyéb tartalmakat a kapcsolódáshoz -->

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Főoldal</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözlünk <?php echo $_SESSION['login_client']; ?></a>
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
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Főoldal</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözlünk <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garázs <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">Leadás </a></li>
              <li> <a href="mybookings.php"> Foglalásaim</a></li>
            </ul>
            </li>
          </ul>
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
                        <a href="index.php">Főoldal</a>
                    </li>
                    <li>
                        <a href="clientlogin.php">Dolgozó</a>
                    </li>
                    <li>
                        <a href="customerlogin.php">Ügyfél</a>
                    </li>
                    <li>
                        <a href="#"> GyIK </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Foglalás megerősítve.</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Köszönjük, hogy használod az C-rental Hungary Rendszert! Biztonságos utazást kívánunk. </h2>

 

    <h3 class="text-center"> <strong>A rendelés száma:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <h5 class="text-center">Kérjük, olvassa el az alábbi információkat a rendelésével kapcsolatban.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">A foglalását rögzítettük és elhelyeztük a rendszerünkben.</h3>
                <br>
                <h4>Kérjük, jegyezze fel most a <strong>rendelésszámát</strong>, és tartsa meg, ha kommunikálnia kellene velünk a rendelésével kapcsolatban.</h4>
                <br>
                <h3 style="color: orange;">Számla</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Jármű neve: </strong> <?php echo $car_name; ?></h4>
                <br>
                <h4> <strong>Jármű rendszám:</strong> <?php echo $car_nameplate; ?></h4>
                <br>
                
                <?php     
                if($charge_type == "days"){
                ?>
                     <h4> <strong>Díj:</strong>  <?php echo $fare; ?> Ft /nap</h4>
                <?php } else {
                    ?>
                    <h4> <strong>Díj:</strong>  <?php echo $fare; ?> Ft /km</h4>

                <?php } ?>

                <h4> <strong>Foglalás Dátuma: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Indulás Dátuma: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Visszaérkezés Dátuma: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>Sofőr Neve: </strong> <?php echo $driver_name; ?> </h4>
                <br>
                <h4> <strong>Sofőr Nem: </strong> <?php echo $driver_gender; ?> </h4>
                <br>
                <h4> <strong>Sofőr Jogosítvány Száma: </strong>  <?php echo $dl_number; ?> </h4>
                <br>
                <h4> <strong>Sofőr Kapcsolat:</strong>  <?php echo $driver_phone; ?></h4>
                <br>
                <h4> <strong>Alkalmazott Neve:</strong>  <?php echo $client_name; ?></h4>
                <br>
                <h4> <strong>Alkalmazott Kapcsolata: </strong> <?php echo $client_phone; ?></h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Figyelem! <strong>Ne frissítse ezt az oldalt</strong>, különben a fentebb látható információ elveszik. Ha papír alapú másolatra van szüksége, kérjük, nyomtassa ki most.</h6>
        </div>
    </div>
</body>
<?php } else { ?>
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
            <!-- Navigációs linkek, űrlapok és egyéb tartalmak gyűjtése a kapcsolóhoz -->

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
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garázs <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">Most Visszahozom</a></li>
              <li> <a href="mybookings.php"> Saját Foglalásaim</a></li>
            </ul>
            </li>
          </ul>
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
                <?php   }
                ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
	<div class="jumbotron" style="text-align: center;">
        Rossz dátumot választott ki.
        <br><br>
</div>
                <?php } ?>
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
