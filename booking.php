<!DOCTYPE html>
<html>
<?php 
 include('session_customer.php');
if(!isset($_SESSION['login_customer'])){
    session_destroy();
    header("location: customerlogin.php");
}
?> 
<title>Autó foglalás </title>
<head>
    <script type="text/javascript" src="assets/ajs/angular.min.js"> </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="shortcut icon" type="image/png" href="assets/img/P.png.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>  
    <script type="text/javascript" src="assets/js/custom.js"></script> 
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/clientpage.css" />
</head>
<body ng-app=""> 

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">
                    C-rental Hungary </a>
            </div>

            <?php
                if(isset($_SESSION['login_client'])){
            ?> 
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Kezdőlap</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözöljük, <?php echo $_SESSION['login_client']; ?></a>
                    </li>
                    <li>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Irányítópult <span class="caret"></span> </a>
                                <ul class="dropdown-menu">
                                    <li> <a href="entercar.php">Autó hozzáadása</a></li>
                                    <li> <a href="enterdriver.php">Sofőr hozzáadása</a></li>
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
                }
                else if (isset($_SESSION['login_customer'])){
            ?>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Kezdőlap</a>
                    </li>
                    <li>
                        <a href="#"><span class="glyphicon glyphicon-user"></span> Üdvözöljük, <?php echo $_SESSION['login_customer']; ?></a>
                    </li>
                    <ul class="nav navbar-nav">
                        <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garázs <span class="caret"></span> </a>
                            <ul class="dropdown-menu">
                                <li> <a href="prereturncar.php">Visszaadás most</a></li>
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
        </div>
    </nav>
    
    <div class="container" style="margin-top: 65px;">
        <div class="col-md-7" style="float: none; margin: 0 auto;">
            <div class="form-area">
                <form role="form" action="bookingconfirm.php" method="POST">
                    <br style="clear: both">
                    <br>

                    <?php
                    $car_id = $_GET["id"];
                    $sql1 = "SELECT * FROM cars WHERE car_id = '$car_id'";
                    $result1 = mysqli_query($conn, $sql1);

                    if(mysqli_num_rows($result1)){
                        while($row1 = mysqli_fetch_assoc($result1)){
                            $car_name = $row1["car_name"];
                            $car_nameplate = $row1["car_nameplate"];
                            $ac_price = $row1["ac_price"];
                            $non_ac_price = $row1["non_ac_price"];
                            $ac_price_per_day = $row1["ac_price_per_day"];
                            $non_ac_price_per_day = $row1["non_ac_price_per_day"];
                        }
                    }
                    ?>

                    <h5> Kiválasztott autó:&nbsp;  <b><?php echo($car_name);?></b></h5>
                    <h5> Rendszám:&nbsp;<b> <?php echo($car_nameplate);?></b></h5>

                    <label><h5>Kezdő dátum:</h5></label>
                    <input type="date" name="rent_start_date" min="<?php echo($today);?>" required="">
                    &nbsp; 
                    <label><h5>Végdátum:</h5></label>
                    <input type="date" name="rent_end_date" min="<?php echo($today);?>" required="">

                    <h5> Válassza ki az autó típusát:  &nbsp;
                        <input onclick="reveal()" type="radio" name="radio" value="ac" ng-model="myVar"> <b>Klímával </b>&nbsp;
                        <input onclick="reveal()" type="radio" name="radio" value="non_ac" ng-model="myVar"><b>Klíma nélkül </b>
                    </h5>
                
                    <div ng-switch="myVar"> 
                        <div ng-switch-default>
                            <h5>Díj: <h5>    
                        </div>
                        <div ng-switch-when="ac">
                            <h5>Díj: <b><?php echo($ac_price ." Ft/1km" ." vagy " . $ac_price_per_day ." Ft/nap");?></b><h5>    
                        </div>
                        <div ng-switch-when="non_ac">
                            <h5>Díj: <b><?php echo($non_ac_price ." Ft/1km" ." vagy " . $non_ac_price_per_day ." Ft/nap");?></b><h5>    
                        </div>
                    </div>

                    <h5> Díj típusa:  &nbsp;
                        <input onclick="reveal()" type="radio" name="radio1" value="km"><b> kilóméterenként</b> &nbsp;
                        <input onclick="reveal()" type="radio" name="radio1" value="days"><b> per nap</b>
                    </h5>

                    <br><br>
                    
                    Válasszon sofőrt: &nbsp;
                    <select name="driver_id_from_dropdown" ng-model="myVar1">
                        <?php
                        $sql2 = "SELECT * FROM driver d WHERE d.driver_availability = 'yes' AND d.client_username IN (SELECT cc.client_username FROM clientcars cc WHERE cc.car_id = '$car_id')";
                        $result2 = mysqli_query($conn, $sql2);

                        if(mysqli_num_rows($result2) > 0){
                            while($row2 = mysqli_fetch_assoc($result2)){
                                $driver_id = $row2["driver_id"];
                                $driver_name = $row2["driver_name"];
                                $driver_gender = $row2["driver_gender"];
                                $driver_phone = $row2["driver_phone"];
                    ?>
                        <option value="<?php echo($driver_id); ?>"><?php echo($driver_name); ?>
                    <?php }} 
                    else{
                        ?>
                    Sajnáljuk! Jelenleg nincsenek rendelkezésre álló sofőrök, próbálja meg később...
                        <?php
                    }
                    ?>
                    </select>

                    <div ng-switch="myVar1">
                        <?php
                        $sql3 = "SELECT * FROM driver d WHERE d.driver_availability = 'yes' AND d.client_username IN (SELECT cc.client_username FROM clientcars cc WHERE cc.car_id = '$car_id')";
                        $result3 = mysqli_query($conn, $sql3);

                        if(mysqli_num_rows($result3) > 0){
                            while($row3 = mysqli_fetch_assoc($result3)){
                                $driver_id = $row3["driver_id"];
                                $driver_name = $row3["driver_name"];
                                $driver_gender = $row3["driver_gender"];
                                $driver_phone = $row3["driver_phone"];
                    ?>
                        <div ng-switch-when="<?php echo($driver_id); ?>">
                            <h5>Sofőr neve:&nbsp; <b><?php echo($driver_name); ?></b></h5>
                            <p>Nem:&nbsp; <b><?php echo($driver_gender); ?></b> </p>
                            <p>Kapcsolat:&nbsp; <b><?php echo($driver_phone); ?></b> </p>
                        </div>
                    <?php }} ?>
                    </div>
                    <input type="hidden" name="hidden_carid" value="<?php echo $car_id; ?>">
                    <input type="submit" name="submit" value="Megrendelés" class="btn btn-warning pull-right">     
                </form>
            </div>
            <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
                <h6><strong>Megjegyzés:</strong> Minden nap után további <span class="text-danger">50 000 Ft</span> kerül felszámolásra a lejárt határidő után.</h6>
                <h6><strong>Megjegyzés:</strong> Amennyiben "Klíma nélkül" Kéred az autót, de mégis használod, abban az esetben <span class="text-danger">többszörös felárat</span> számítunk fel. Azért tettük ezt a lehetőséget választhatóbbá, hogy egy picit kedvezzünk árban azoknak, akik védik a bolygónkat.</h6>
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
