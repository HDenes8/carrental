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
<link rel="stylesheet" type="text/css" media="screen" href="assets/css/bookingconfirm.css" />
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
                   C-rental Hungary </a>
            </div>
            <!-- Navigációs linkek, űrlapok és egyéb tartalmak összegyűjtése -->

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
                        <a href="index.php">Kezdőlap</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözöljük <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garázs <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="prereturncar.php">Leadás most</a></li>
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
                        <a href="#"> Gyakran Ismételt Kérdések </a>
                    </li>
                </ul>
            </div>
                <?php   }
                ?>
            <!-- Navigáció lezárása -->
        </div>
        <!-- Konténer lezárása -->
    </nav>
<body>

<?php 
$id = $_GET["id"];
$distance = NULL;
$distance_or_days = $conn->real_escape_string($_POST['distance_or_days']);
$fare = $conn->real_escape_string($_POST['hid_fare']);
$total_amount = $distance_or_days * $fare;
$car_return_date = date('Y-m-d');
$return_status = "R";
$login_customer = $_SESSION['login_customer'];

$sql0 = "SELECT rc.id, rc.rent_end_date, rc.charge_type, rc.rent_start_date, c.car_name, c.car_nameplate FROM rentedcars rc, cars c WHERE id = '$id' AND c.car_id = rc.car_id";
$result0 = $conn->query($sql0);

if(mysqli_num_rows($result0) > 0) {
    while($row0 = mysqli_fetch_assoc($result0)){
            $rent_end_date = $row0["rent_end_date"];  
            $rent_start_date = $row0["rent_start_date"];
            $car_name = $row0["car_name"];
            $car_nameplate = $row0["car_nameplate"];
            $charge_type = $row0["charge_type"];
    }
}

function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}

$extra_days = dateDiff("$rent_end_date", "$car_return_date");
$total_fine = $extra_days*200;

$duration = dateDiff("$rent_start_date","$rent_end_date");

if($extra_days>0) {
    $total_amount = $total_amount + $total_fine;  
}

if($charge_type == "days"){
    $no_of_days = $distance_or_days;
    $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', no_of_days='$no_of_days', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
} else {
    $distance = $distance_or_days;
    $sql1 = "UPDATE rentedcars SET car_return_date='$car_return_date', distance='$distance', no_of_days='$duration', total_amount='$total_amount', return_status='$return_status' WHERE id = '$id' ";
}

$result1 = $conn->query($sql1);

if ($result1){
     $sql2 = "UPDATE cars c, driver d, rentedcars rc SET c.car_availability='yes', d.driver_availability='yes' 
     WHERE rc.car_id=c.car_id AND rc.driver_id=d.driver_id AND rc.customer_username = '$login_customer' AND rc.id = '$id'";
     $result2 = $conn->query($sql2);
}
else {
    echo $conn->error;
}
?>

    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span>Jármű leadása</h1>
        </div>
    </div>
    <br>

    <h2 class="text-center"> Köszönjük, hogy a Car Rentals-t választotta! Biztonságos utat kívánunk. </h2>

    <h3 class="text-center"> <strong>A rendelés száma:</strong> <span style="color: blue;"><?php echo "$id"; ?></span> </h3>


    <div class="container">
        <h5 class="text-center">Kérjük, olvassa el az alábbi információkat a rendelésével kapcsolatban.</h5>
        <div class="box">
            <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
                <h3 style="color: orange;">A foglalását rögzítettük és beillesztettük rendszerünkbe.</h3>
                <br>
                <h4>Kérjük, jegyezze fel a <strong>rendelési számát</strong> és mentse el, ha kapcsolatba kívánna lépni velünk a rendelésével kapcsolatban.</h4>
                <br>
                <h3 style="color: orange;">Számla</h3>
                <br>
            </div>
            <div class="col-md-10" style="float: none; margin: 0 auto; ">
                <h4> <strong>Jármű neve: </strong> <?php echo $car_name;?></h4>
                <br>
                <h4> <strong>Jármű rendszáma:</strong> <?php echo $car_nameplate; ?></h4>
                <br>
                <h4> <strong>Díj:&nbsp;</strong>   <?php 
            if($charge_type == "days"){
                    echo ($fare . " Ft /nap");
                } else {
                    echo ($fare . " Ft /km");
                }
            ?></h4>
                <br>
                <h4> <strong>Foglalás dátuma: </strong> <?php echo date("Y-m-d"); ?> </h4>
                <br>
                <h4> <strong>Kezdés dátuma: </strong> <?php echo $rent_start_date; ?></h4>
                <br>
                <h4> <strong>Bérlés vége: </strong> <?php echo $rent_end_date; ?></h4>
                <br>
                <h4> <strong>Autó visszaadás dátuma: </strong> <?php echo $car_return_date; ?> </h4>
                <br>
                <?php if($charge_type == "days"){?>
                    <h4> <strong>Napok száma:</strong> <?php echo $distance_or_days; ?>nap(ok)</h4>
                <?php } else { ?>
                    <h4> <strong>Megtett távolság:</strong> <?php echo $distance_or_days; ?>km(s)</h4>
                <?php } ?>
                <br>
                <?php
                    if($extra_days > 0){
                        
                ?>
                <h4> <strong>Teljes büntetés:</strong> <label class="text-danger"> Ft <?php echo $total_fine; ?>/- </label> <?php echo $extra_days;?> extra napra.</h4>
                <br>
                <?php } ?>
                <h4> <strong>Teljes Összeg: </strong>  <?php echo $total_amount; ?> Ft    </h4>
                <br>
            </div>
        </div>
        <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
            <h6>Figyelem! <strong>Ne frissítse ezt az oldalt</strong>, különben a fenti információ elveszik. Ha papír alapú másolatot szeretne az oldalról, nyomtassa ki most.</h6>
        </div>
    </div>

</body>
<footer class="site-footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <h5>© <?php echo date("Y"); ?> Autó kölcsönző</h5>
                </div>
            </div>
        </div>
    </footer>
</html>

