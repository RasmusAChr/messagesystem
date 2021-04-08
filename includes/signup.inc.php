<?php

// Tjekker om brugeren er kommet ind ved at klikke på knappen, fremfor at skrive url'en.
if (isset($_POST["submit"])) { // Hvis brugeren har trykket på registrer knappen.
    
    $brugernavn = $_POST["brugernavn"];
    $fornavn = $_POST["fornavn"];
    $efternavn = $_POST["efternavn"];
    $password = $_POST["password"];
    $passwordgentag = $_POST["passwordgentag"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Tjekker for fejl (error handlers)
    if (emptyInputSignup($brugernavn, $fornavn, $efternavn, $password, $passwordgentag) != false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidBrugernavn($brugernavn) != false) {
        header("location: ../signup.php?error=invalidbrugernavn");
        exit();
    }
    if (passwordMatch($password, $passwordgentag) != false) {
        header("location: ../signup.php?error=passworddontmatch");
        exit();
    }
    if (brugernavneksisterer($conn, $brugernavn) != false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    
    // Hvis ingen fejl, så opret bruger
    createUser($conn, $brugernavn, $fornavn, $efternavn, $password);

}
else { // Ellers gå tilbage til registrer siden.
    header("location: ../signup.php");
    exit();
}