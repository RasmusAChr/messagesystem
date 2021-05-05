<?php

if (isset($_POST["submit"])) {

    $brugernavn = $_POST["brugernavn"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Tjekker for fejl (error handler)

    // Hvis det angivet brugernavn ikke er tomt.
    if (empty($brugernavn) == false) {

        header("location: ../sebeskeder.php?brugernavn='".$brugernavn."'");
        exit();

    }

    // Hvis det angivet brugernavn er tomt.
    else {
        header("location: ../sebeskeder.php");
        exit();
    }

}

else {
    header("location: ../sebeskeder.php");
    exit();

}