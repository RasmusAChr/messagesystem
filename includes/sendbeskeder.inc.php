<?php

if (isset($_POST["submit"])) {      // Gør at følgende kode kun kører ved at trykke på send knappen
                                    // Ellers kan man skrive det i URL'en og stadig kører denne kode

    $modtagere = $_POST["modtager"];    // Tager den tekst der står i modtager bosken og laver det om til en variabel (string)
    $modtagere_array = array_map('trim', preg_split("/,/", $modtagere));    // Fjerner mellemrum og laver et array af modtagere ved at dele stregen ved komma

    $besked = $_POST["besked"];         // Gemmer beskeden i en variabel
    
    require_once 'dbh.inc.php';         // Adgang til database
    require_once 'functions.inc.php';   // Adgang til egne funktioner

    // Tjekker for fejl (error handelers)
    if (emptyInputLogin($modtagere, $besked) != false) {
        header("location: ../sendbeskeder.php?error=emptyinput");
        exit();
    }

    // Sender beskeden med vores "sendMessage" funtion
    sendMessage($conn, $modtagere_array, $besked);  
}
else {
    header("location: ../sendbeskeder.php");
    exit();
}