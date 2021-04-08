<?php
// Hvis dokumentet kun indeholder PHP, så behøves slut tegnet for php ikke.

$serverName = "localhost";
$dBUserName = "root";
$dBPassword = "";
$dBName = "beskedsystem";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // viser SQL fejl istedet for gennerel PHP fejl
$conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}