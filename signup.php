<?php
    include_once 'header.php';
?>
            <!-- Registeringformularen -->
            <section class="signup-form">
                <h2>Registrer</h2>
                <form action="includes/signup.inc.php" method="post"> <!-- Forklar post -->
                    <input type="text" name="brugernavn" placeholder="Brugernavn...">
                    <input type="text" name="fornavn" placeholder="Fornavn...">
                    <input type="text" name="efternavn" placeholder="Efternavn ...">
                    <input type="password" name="password" placeholder="Kodeord..."> <!-- Type=password gør at der kommer prikker når man skriver -->
                    <input type="password" name="passwordgentag" placeholder="Gentag kodeord...">
                    <button type="submit" name="submit">Registrer</button>
                </form>

                <?php
                if (isset($_GET["error"])) { // Tjekker om der kommer en fejl.
                    if($_GET["error"] == "emptyinput") { // Tjekker om fejlen skyldes manglende udfyldning.
                        echo "<p>Udfyld alle felter.</p>";
                    }
                    else if ($_GET["error"] == "invalidbrugernavn") { // Tjekker om fejlen skyldes et forkert brugernavn.
                        echo "<p>Ugyldigt brugernavn</p>";
                    }
                    else if ($_GET["error"] == "passworddontmatch") { // Tjekker om fejlen skyldes at kodeordet er forkert.
                        echo "<p>Kodeord stemmer ikke overens.</p>";
                    }
                    else if ($_GET["error"] == "stmtfailed") { // Tjekker om fejlen skyldes en fejl i et prepared statement (en sql streng som skal udføres mange gange, og derfor er mere effektiv end en normal sql streng).
                        echo "<p>Noget gik galt.</p>";
                    }
                    else if ($_GET["error"] == "brugernavneksisterer") { // Tjekker om fejlen skyldes at brugernavnet allerede eksisterer.
                        echo "<p>Brugernavnet eksistrer allerede.</p>";
                    }
                    else if ($_GET["error"] == "none") { // Ingen fejl.
                        echo "<p>Registrering fuldført.</p>";
                    }
                }
                ?> 

            </section>

             

<?php
    include_once 'footer.php';
?>            
