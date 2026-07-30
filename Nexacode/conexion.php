<?php
$servername = "localhost";
$username = "root"; // cámbialo si tu usuario es distinto
$password = "";     // cámbialo si tu contraseña es distinta
$dbname = "nexacodel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
