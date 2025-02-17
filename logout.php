<?php
session_start();
if(session_destroy()) // Az összes munkamenet törlése
{
    header("Location: index.php"); // Átirányítás a kezdőlapra
}
?>
