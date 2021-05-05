<?php

// Hvis brugeren er kommet ind på siden ved at trykke på en knap.
if (isset($_POST["submit"])) {

    // Gem brugernavn og password i variabler
    $brugernavn = $_POST["brugernavn"];
    $password = $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Tjekker for fejl (error handler)
    if (emptyInputLogin($brugernavn, $password) != false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    // Hvis ingen fejl, så kør funktion som logger brugeren ind
    loginUser($conn, $brugernavn, $password);
}
else {
    header("location: ../login.php");
    exit();
}