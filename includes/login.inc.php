<?php

if (isset($_POST["submit"])) {

    $brugernavn = $_POST["brugernavn"];
    $password = $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Tjekker for fejl (error handelers)
    if (emptyInputLogin($brugernavn, $password) != false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $brugernavn, $password);
}
else {
    header("location: ../login.php");
    exit();
}