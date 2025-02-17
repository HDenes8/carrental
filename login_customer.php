<?php
session_start(); // Munkamenet kezdése
$error=''; // Változó a hibaüzenet tárolásához

if (isset($_POST['submit'])) {
    if (empty($_POST['customer_username']) || empty($_POST['customer_password'])) {
        $error = "Felhasználónév vagy jelszó érvénytelen";
    } else {
        // Felhasználónév és jelszó definiálása
        $customer_username = $_POST['customer_username'];
        $customer_password = $_POST['customer_password'];

        // Kapcsolat felépítése a szerverrel (server_name, user_id és password paraméterek átadása)
        require 'connection.php';
        $conn = Connect();

        // SQL lekérdezés a regisztrált felhasználók adatainak lekéréséhez és a felhasználói egyezés megkereséséhez.
        $query = "SELECT customer_username, customer_password FROM customers WHERE customer_username=? AND customer_password=? LIMIT 1";

        // MySQL injection elleni védelem biztonsági célból
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $customer_username, $customer_password);
        $stmt->execute();
        $stmt->bind_result($customer_username, $customer_password);
        $stmt->store_result();

        if ($stmt->fetch())  // A sor tartalmának lekérése
        {
            $_SESSION['login_customer'] = $customer_username; // Munkamenet inicializálása
            header("location: index.php"); // Átirányítás másik oldalra
        } else {
            $error = "Felhasználónév vagy jelszó érvénytelen";
        }
        mysqli_close($conn); // Kapcsolat bezárása
    }
}
?>
