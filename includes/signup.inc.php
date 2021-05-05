<?php

// Tjekker om brugeren er kommet ind ved at klikke på knappen, fremfor at skrive url'en.
if (isset($_POST["submit"])) { // Hvis brugeren har trykket på registrer knappen.
    
    // Gemmer en masse angivet information i variabler 
    $brugernavn = $_POST["brugernavn"];
    $fornavn = $_POST["fornavn"];
    $efternavn = $_POST["efternavn"];
    $password = $_POST["password"];
    $passwordgentag = $_POST["passwordgentag"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // -- Tjekker for fejl (error handlers) --
    
    // Har brugeren glemt at udfylde et felt?
    if (emptyInputSignup($brugernavn, $fornavn, $efternavn, $password, $passwordgentag) != false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    // Har brugeren skrevet til ugyldigt brugernavn?
    if (invalidBrugernavn($brugernavn) != false) {
        header("location: ../signup.php?error=invalidbrugernavn");
        exit();
    }

    // Matcher begge de angivet kodeord?
    if (passwordMatch($password, $passwordgentag) != false) {
        header("location: ../signup.php?error=passworddontmatch");
        exit();
    }

    // Eksisterer brugernavnet i forvejen?
    if (brugernavneksisterer($conn, $brugernavn) != false) {
        header("location: ../signup.php?error=brugernavneksisterer");
        exit();
    }
    
    // Hvis ingen fejl, så opret bruger
    createUser($conn, $brugernavn, $fornavn, $efternavn, $password);

}
else { // Ellers gå tilbage til registrer siden.
    header("location: ../signup.php");
    exit();
}