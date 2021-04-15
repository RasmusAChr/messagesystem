<?php
// Hvis dokumentet kun indeholder PHP, så behøves slut tegnet for php ikke.

$serverName = "localhost";
$dBUserName = "root";
$dBPassword = "";
$dBName = "beskedsystem";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Viser SQL fejl istedet for generel PHP fejl.
$conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName); // Tilslutter til databasen med de givne variabler.

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error()); // Hvis det ikke opstår en forbindelse, så afslut forbindelsen og viser fejlen.
}