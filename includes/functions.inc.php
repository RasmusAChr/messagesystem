<?php

function emptyInputSignup($brugernavn, $fornavn, $efternavn, $password, $passwordgentag) 
{
    $result;
    if (empty($brugernavn) || empty($fornavn) || empty($efternavn) || empty($password) || empty($passwordgentag))
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

function invalidBrugernavn($brugernavn) 
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $brugernavn))
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $passwordgentag) 
{
    $result;
    if ($password !== $passwordgentag)
    {
        $result = true;
    }
    else 
    {
        $result = false;
    }
    return $result;
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
    $result;
    if (empty($brugernavn) || empty($password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
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