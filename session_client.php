<?php
// A mysqli_connect() függvény új kapcsolatot nyit a MySQL szerverhez.
require 'connection.php';
$conn = Connect();

session_start();// Munkamenet indítása

// Munkamenet tárolása
$user_check=$_SESSION['login_client'];

// SQL lekérdezés az felhasználó teljes információinak lekéréséhez
$query = "SELECT client_username FROM clients WHERE client_username = '$user_check'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['client_username'];
?>
