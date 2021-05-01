<?php

function emptyInputSignup($brugernavn, $fornavn, $efternavn, $password, $passwordgentag) 
{
    $result; // Laver variabel som skal indeholde et resultat.
    if (empty($brugernavn) || empty($fornavn) || empty($efternavn) || empty($password) || empty($passwordgentag)) // Tjekker om nogle af felterne er tomme.
    {
        $result = true; // Ja mindst et felt er tomt
    }
    else 
    {
        $result = false; // Nej ingen felter er ikke tomme.
    }
    return $result; // Retunerer resultatet til der hvor funktionen blev kaldt.
}

function invalidBrugernavn($brugernavn) 
{
    $result; // Laver variabel som skal indeholde et resultat.
    if (!preg_match("/^[a-zA-Z0-9]*$/", $brugernavn)) // Tjekker om der er andre tegn end dem som er angivet i preg_match(), som er en php funktion.
    {
        $result = true; // Ja der er andre tegn end dem angivet.
    }
    else 
    {
        $result = false; // Nej der er ingen andre tegn end dem angivet.
    }
    return $result; // Retunerer resultatet til der hvor funktionen blev kaldt.
}

function passwordMatch($password, $passwordgentag) 
{
    $result; // Laver variabel som skal indeholde et resultat.
    if ($password !== $passwordgentag) // Har brugeren skrevet det samme kodeord 2 gange?
    {
        $result = true; // Brugeren har skrevet det samme begge steder.
    }
    else 
    {
        $result = false; // Brugeren har ikke skrevet det samme begge steder.
    }
    return $result; // Retunerer resultatet til der hvor funktionen blev kaldt.
}

function brugernavneksisterer($conn, $brugernavn) 
{
    // Laver prepared statement for at undgå SQL injection.
    $sql = "SELECT * FROM bruger WHERE brugernavn = ?;";
    $stmt = mysqli_stmt_init($conn);

    // Tjekker om forbindelsen fejler
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $brugernavn);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $brugernavn, $fornavn, $efternavn, $password) 
{
    // Laver prepared statement for at undgå SQL injection.
    $sql = "INSERT INTO bruger (brugernavn, fornavn, efternavn, kodeord) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    // Tjekker om forbindelsen fejler
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    // Hasher password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $brugernavn, $fornavn, $efternavn, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Når brugeren er blevet lavet
    header("location: ../signup.php?error=none");
    exit();

}

function emptyInputLogin($brugernavn, $password) 
{
    $result; // Laver variabel som skal indeholde et resultat.
    if (empty($brugernavn) || empty($password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result; // Retunerer resultatet til der hvor funktionen blev kaldt.
}

function loginUser($conn, $brugernavn, $password) {
    $brugernavnEksistere = brugernavneksisterer($conn, $brugernavn);

    if ($brugernavnEksistere == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $hashedPassword = $brugernavnEksistere["kodeord"];
    $checkPassword = password_verify($password, $hashedPassword);

    if ($checkPassword == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPassword == true) {
        session_start();
        $_SESSION["brugernavn"] = $brugernavnEksistere["brugernavn"];
        $_SESSION["fornavn"] = $brugernavnEksistere["fornavn"];
        header("location: ../index.php");
        exit();
    }
}

function sendMessage($conn, $modtagere_array, $besked) 
{
    session_start();        // Måske riski (research) https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    $afsender = $_SESSION["brugernavn"];

    foreach($modtagere_array as $value){
        $ModtagerEksistere = brugernavneksisterer($conn, $value);

        if ($ModtagerEksistere == false) {
            header("location: ../sendbeskeder.php?error=wrongmodtager");
            exit();
        }
    }

    $sql = "INSERT INTO besked (afsender_brugernavn, besked_indhold) VALUES (?,?)";
    $stmt = mysqli_stmt_init($conn);

    // Tjekker om forbindelsen fejler
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sendbeskeder.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $afsender, $besked);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Find besked id for den netop oprettede besked record (Seneste id med AUTO INCREMENT)
    $latest_besked_id = mysqli_insert_id($conn);

    // Her skal der laves relationstabel med en anden løsning
    $sql = "INSERT INTO besked_modtager (besked_id, modtager_brugernavn) VALUES (?,?)";
    $stmt = mysqli_stmt_init($conn);

    // Tjekker om forbindelsen fejler
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../sendbeskeder.php?error=stmtfailed");
        exit();
    }

    foreach($modtagere_array as $value){
        mysqli_stmt_bind_param($stmt, "is", $latest_besked_id, $value);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    
    
    // Når beskeden er sendt
    header("location: ../sendbeskeder.php?error=none");
    exit();
}

