<!-- Dette dokument indeholder start tags og header for siden -->
<!-- Bliver inkluderet nederest på hver side -->

<?php
   session_start();
?>

<!DOCTYPE html>
<html lang="dk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Beskedsystem</title>
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/style.css"> 
    </head>

    <body>
        <nav>
            <div class="wrapper">
                <ul>
                    <?php
                        if (isset($_SESSION["brugernavn"])) { // Hvis brugeren er logget ind, så vis nedenstående (Hvis sessionens brugernavn er sat, så er udsagnet true).
                            // Viser disse sider i navigationsbaren, hvis man er logget ind.
                            echo "<li><a href='includes/logout.inc.php'>Log ud</a></li>";
                            echo "<li><a href='sendbeskeder.php'>Send besked</a></li>";
                            echo "<li><a href='sebeskeder.php'>Se beskeder</a></li>";
                        }
                        else { // Hvis brugeren ikke er logget ind.

                            // Viser sider i navigationsbaren, hvis man ikke er logget ind.
                            echo "<li><a href='signup.php'>Registrer</a></li>";
                            echo "<li><a href='login.php'>Login</a></li>";
                        }
                    ?>
                    <li><a href='index.php'>Hjem</a></li>
                    <?php
                    if (isset($_SESSION["brugernavn"])) {
                        echo "<li><p style='color:white;position:fixed;left:20px;'>".$_SESSION["brugernavn"]."</p></li>";
                    }
                    ?>
                </ul>
            </div>
        </nav>
        
        <div class="wrapper">