<?php
    include_once 'header.php';
?>
            
            <section class="sebeskeder-section">
                <h1>Send beskeder</h1>
                <p>På denne side kommer man til at kunne oprette og sende beskeder</p>
                
                <!-- Input felt og knap til bruger kan sende besked-->
                <form action="includes/sendbeskeder.inc.php" method="post"> <!-- Data som bliver sendt med method=post er gemt inde i HTTP forespørgslen. Bruges til sensitiv data. -->
                    <input type="text" name="modtager" placeholder="Modtager...">
                    <textarea id="beskedomraade" name="besked" rows="4" placeholder="Skriv din besked her..."></textarea>
                    <button type="submit" name="submit">Send</button>
                </form>

                <?php 
                    // Tjekker for fejl i url og skriver noget tekst til brugeren om hvad der er sket af fejl (hvis det er en fejl)

                    if (isset($_GET["error"])) { // Tjekker om der kommer en fejl.
                        if($_GET["error"] == "emptyinput") { // Tjekker om fejlen skyldes manglende udfyldning.
                            echo "<p>Udfyld alle felter.</p>";
                        }
                        else if ($_GET["error"] == "wrongmodtager") { // Tjekker om fejlen skyldes et forkert login.
                            echo "<p>Du har skrevet en bruger der ikke eksistere.</p>";
                        }
                        else if ($_GET["error"] == "stmtfailed") { // Tjekker om fejlen skyldes et forkert login.
                            echo "<p>Der er en fejl med forbindelsen til databasen</p>";
                        }
                        else if ($_GET["error"] == "none") { // Hvis der ikke er nogle fejl
                            echo "<p>Beskeden er sendt</p>";
                        }
                    }
                ?>

            </section>

<?php
    include_once 'footer.php';
?>
