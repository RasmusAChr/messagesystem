<?php

session_start();    // Start den for at være sikker på at den kører.
session_unset();    // Fjern alle variabler fra sessionen.
session_destroy();  // Afslut sessionen.

header("location: ../index.php");
exit();