<?php

if (isset($_POST["submit"])) {

    $modtager = $_POST["modtager"];
    $besked = $_POST["besked"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Tjekker for fejl (error handelers)
    if (emptyInputLogin($modtager, $besked) != false) {
        header("location: ../sendbeskeder.php?error=emptyinput");
        exit();
    }

    // Send besked
    sendMessage($conn, $modtager, $besked);
}
else {
    header("location: ../sendbeskeder.php");
    exit();
}