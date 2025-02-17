<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/reset.css">
    <!-- CSS visszaállítás -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Stílusforrás -->
    <script src="js/modernizr.js"></script>
    <!-- Modernizr -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <link rel="stylesheet" href="assets/w3css/w3.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <title>GYIK | C-Rental Hungary</title>
</head>

<body>

    <!-- Navigáció -->
    <nav class="navbar navbar-custom" role="navigation" style="color: black">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    </button>
                <a class="navbar-brand page-scroll" href="../index.php">
                   C-Rental Hungary </a>
            </div>
            <!-- Gyűjtsd össze a navigációs linkeket, formákat és egyéb tartalmat a kinyíló menühöz -->

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
            }
                else {
            ?>

                        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="../index.php">Kezdőlap</a>
                                </li>
                                <li>
                                    <a href="../clientlogin.php">Munkatárs</a>
                                </li>
                                <li>
                                    <a href="../customerlogin.php">Ügyfél</a>
                                </li>
                                <li>
                                    <a href="../faq/index.php"> GYIK </a>
                                </li>
                            </ul>
                        </div>
                        <?php   }
                ?>
                        <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <section class="cd-faq">
        <ul class="cd-faq-categories">
            <li><a class="selected" href="#basics">Alapok</a></li>
            <li><a href="#membership">Tagság</a></li>
            <li><a href="#chauffeur">Sofőrszolgáltatás</a></li>
        </ul>
        <!-- cd-faq-categories -->

        <div class="cd-faq-items">
            <ul id="basics" class="cd-faq-group">
                <li class="cd-faq-title">
                    <h2>Alapok</h2>
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Hogyan fizethetem a kölcsönzésemet?</a>
                    <div class="cd-faq-content">
                        <p>A C-Rentals örömmel fogadja a Mastercard és a Visa kártyákat. Személyes fizetést is elfogadunk. Szeretnénk tájékoztatni, hogy jelenleg  a készpénzt csak nagy címletekben fogadjuk el.</p>
                    </div>
                    <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">Mi van, ha találok egy jobb árat autókölcsönzésre?</a>
                    <div class="cd-faq-content">
                        <p>Az C-Rental Hungary egyik nagyszerű tulajdonsága, hogy az áraink és szolgáltatásaink garantáltan a legjobbak az iparágban. Ha talál egy versenytársnál alacsonyabb árat, és az ár egy összehasonlítható járművet, azonos feltételeket, helyszíneket és kölcsönzési díjakat tartalmaz, örömmel csökkentjük az árat Önnek. Kérjük, mindenképp a foglalás előtt jelezze szándékát, mert fizetés után már reklamációt nem fogadunk el!</div>
                    <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">Szükségem lesz jogosítványra autókölcsönzéshez?</a>
                    <div class="cd-faq-content">
                        <p>Igen, mindenképpen csak jogosítvánnyal rendelkező személy vezetheti a bérelt gépjárműveket. Elfogadunk más országból származó jogosítványt is, illetve kitétel, hogy 5 évnél régebbi jogosítvánnyal veheted csak igénybe szolgáltatásainkat.</p>
                    </div>
                    <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">Van-e plusz költség, ha a kölcsönzött autót a dátum lejárat után adom vissza?</a>
                    <div class="cd-faq-content">
                        <p>Igen, 50 000 Ft díjat számolunk fel a lejárat után minden egyes nap. Távolságtól függően további díjakat számíthatunk fel.</p>
                    </div>
                    <!-- cd-faq-content -->
                </li>
            </ul>
            <!-- cd-faq-group -->

            <ul id="membership" class="cd-faq-group">
                <li class="cd-faq-title">
                    <h2>Tagság</h2>
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Miért érdemes regisztrálnom?</a>
                    <div class="cd-faq-content">
                        <p>Az oldalunkon a regisztráció mindenképpen kötelező, ellenkező esetben csak személyesen bérelhetsz járművet. Regisztrációval sokkal rugalmasabban megy a bérlés, és hamarabb megkaphatod a bérautódat. </p>
                    </div>
                    <!-- cd-faq-content -->
                </li>

                
                <li>
                    <a class="cd-faq-trigger" href="#0">Hogyan jelentkezhetek be?</a>
                    <div class="cd-faq-content">
                        <p>Amint regisztrált, átirányítjuk a bejelentkezési képernyőre. Amikor bejelentkezik, egy kis sávot láthat a képernyő jobb felső sarkában, amely üdvözli Önt webhelyünkön. </p>
                    </div>
                    <!-- cd-faq-content -->
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Mi a helyzet a magánéletemmel?</a>
                    <div class="cd-faq-content">
                        <p>Az Ön magánélete számunkra nagyon fontos. Amíg nem osztja meg a felhasználónevét és jelszavát másokkal, senki sem fogja látni vagy szerkeszteni a személyes információit. További információért olvassa el az adatvédelmi irányelveinket.</p>
                    </div>
                    <!-- cd-faq-content -->
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Mi van, ha megosztom a számítógépemet másokkal?</a>
                    <div class="cd-faq-content">
                        <p>Ha másokkal osztja meg a számítógépét, akkor ajánljuk, hogy jelentkezzen ki, amikor befejezte a munkamenetet a webhelyünkön. És amikor bejelentkezik, győződjön meg róla, hogy a 'Jelszavam mentése ezen a számítógépen' melletti jelölőnégyzet nincs bejelölve. Kérjük, hogy írja le jelszavát máshova.</p>
                </li>
                        
<li>
    <a class="cd-faq-trigger" href="#0">Tárolódik a hitelkártya információm a fiókomon?</a>
    <div class="cd-faq-content">
        <p>Nem. Mi nem tárolunk semmilyen hitelkártya információt a fiókodon.</p>
    </div>
    <!-- cd-faq-content -->
</li>
</ul>
<!-- cd-faq-group -->

<ul id="chauffeur" class="cd-faq-group">
    <li class="cd-faq-title">
        <h2>Sofőrszolgálat</h2>
    </li>
    <li>
        <a class="cd-faq-trigger" href="#0">Hogyan képzeljem el ezt a szolgáltatást?</a>
        <div class="cd-faq-content">
            <p>Sofőrt küldünk ki az autóval, amennyiben online adtad le rendelésed, aki házhoz viszi neked az autót. Nem ő fog helyetted vezetni, ő csak a szállításban segít.</p>
        </div>
        <!-- cd-faq-content -->
    </li>

    <li>
        <a class="cd-faq-trigger" href="#0">Miért tudok sofőrt választani?</a>
        <div class="cd-faq-content">
            <p>Azért tudsz sofőrt választani, hogy igényeidnek megfelelően, előre egyeztetve akármikor tudj vele beszélni, amikor bármi gondod van. Időpontot tudtok megbeszélni, mikor hozza vagy éppen vigye a bérelt járművet.</p>
        <!-- cd-faq-content -->
    </li>

    
</ul>
<!-- cd-faq-group -->
</div>
<!-- cd-faq-items -->
<a href="#0" class="cd-close-panel">Bezárás</a>
</section>
<!-- cd-faq -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery.mobile.custom.min.js"></script>
<script src="js/main.js"></script>
<!-- Resource jQuery -->
</body>

</html>