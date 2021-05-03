<!-- Her bliver headeren inkluderet -->

<?php
    include_once 'header.php';
?>
            
            <section class="index-intro">
                <h1>Startside</h1>

                <?php
                    if (isset($_SESSION["brugernavn"])) { // Hvis brugeren er logget ind, så vis nedenstående (Hvis sessionens brugernavn er sat, så er udsagnet true).
                        echo "<p>Hej med dig " . $_SESSION["fornavn"] . ".</p>"; // Giver brugeren en velkomst.
                    }
                    else { // Hvis brugeren ikke er logget ind.
                        echo "<p>Du er ikke logget ind.</p>"; // Fortæller at brugeren ikke er logget ind. 
                    }
                ?>

            </section>

<!-- Her bliver footeren inkluderet -->
<?php
    include_once 'footer.php';
?>            
