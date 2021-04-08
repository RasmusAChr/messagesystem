 
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
        <!-- Bootstrap 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        -->
    </head>

    <body>
        <nav>
            <div class="wrapper">
                <ul>
                    <?php
                        if (isset($_SESSION["brugernavn"])) {
                            echo "<li><a href='includes/logout.inc.php'>Log ud</a></li>";
                            echo "<li><a href='index.php'>Send besked</a></li>";
                            echo "<li><a href='sebeskeder.php'>Se beskeder</a></li>";
                        }
                        else {
                            echo "<li><a href='signup.php'>Registrer</a></li>";
                            echo "<li><a href='login.php'>Login</a></li>";
                        }
                    ?>
                    <li><a href='index.php'>Hjem</a></li>
                </ul>
            </div>
        </nav>
        
        <div class="wrapper">