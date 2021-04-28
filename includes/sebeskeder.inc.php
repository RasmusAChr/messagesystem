<?php

if (isset($_POST["submit"])) {

    $brugernavn = $_POST["brugernavn"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Tjekker for fejl (error handelers)

    if (empty($brugernavn) == false) {

        header("location: ../sebeskeder.php?brugernavn='".$brugernavn."'");
        exit();

    }

    else {
        header("location: ../sebeskeder.php?error=emptyinput");
        exit();
    }

}

else {
    header("location: ../sebeskeder.php");
    exit();

}