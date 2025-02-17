<?php
session_start(); // Munkamenet kezdése
$error=''; // Változó a hibaüzenet tárolásához

if (isset($_POST['submit'])) {
    if (empty($_POST['client_username']) || empty($_POST['client_password'])) {
        $error = "Felhasználónév vagy jelszó érvénytelen";
    } else {
        // Felhasználónév és jelszó definiálása
        $client_username = $_POST['client_username'];
        $client_password = $_POST['client_password'];

        // Kapcsolat felépítése a szerverrel (server_name, user_id és password paraméterek átadása)
        require 'connection.php';
        $conn = Connect();

        // SQL lekérdezés a regisztrált felhasználók adatainak lekéréséhez és a felhasználói egyezés megkereséséhez
        $query = "SELECT client_username, client_password FROM clients WHERE client_username=? AND client_password=? LIMIT 1";

        // MySQL injection elleni védelem biztonsági célból
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $client_username, $client_password);
        $stmt->execute();
        $stmt->bind_result($client_username, $client_password);
        $stmt->store_result();

        if ($stmt->fetch())  // A sor tartalmának lekérése
        {
            $_SESSION['login_client'] = $client_username; // Munkamenet inicializálása
            header("location: index.php"); // Átirányítás másik oldalra
        } else {
            $error = "Felhasználónév vagy jelszó érvénytelen";
        }
        mysqli_close($conn); // Kapcsolat bezárása
    }
}
?>
