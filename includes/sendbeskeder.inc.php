<?php

if (isset($_POST["submit"])) {      // Gør at følgende kode kun kører ved at trykke på send knappen
                                    // Ellers kan man skrive det i URL'en og stadig kører denne kode

    $modtagere = $_POST["modtager"];
    $modtagere_array = array_map('trim', preg_split("/,/", $modtagere));

    $besked = $_POST["besked"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Tjekker for fejl (error handelers)
    if (emptyInputLogin($modtagere, $besked) != false) {
        header("location: ../sendbeskeder.php?error=emptyinput");
        exit();
    }

    // Send besked
    sendMessage($conn, $modtagere_array, $besked);
}
else {
    header("location: ../sendbeskeder.php");
    exit();
}