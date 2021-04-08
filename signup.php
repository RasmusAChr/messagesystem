<?php
    include_once 'header.php';
?>
            
            <section class="signup-form">
                <h2>Registrer</h2>
                <form action="includes/signup.inc.php" method="post"> <!-- Forklar post -->
                    <input type="text" name="brugernavn" placeholder="Brugernavn...">
                    <input type="text" name="fornavn" placeholder="Fornavn...">
                    <input type="text" name="efternavn" placeholder="Efternavn ...">
                    <input type="password" name="password" placeholder="Kodeord...">
                    <input type="password" name="passwordgentag" placeholder="Gentag kodeord...">
                    <button type="submit" name="submit">Registrer</button>
                </form>

                <?php
                if (isset($_GET["error"])) {
                    if($_GET["error"] == "emptyinput") {
                        echo "<p>Udfyld alle felter.</p>";
                    }
                    else if ($_GET["error"] == "invalidbrugernavn") {
                        echo "<p>Ugyldigt brugernavn</p>";
                    }
                    else if ($_GET["error"] == "passworddontmatch") {
                        echo "<p>Kodeord stemmer ikke overens.</p>";
                    }
                    else if ($_GET["error"] == "stmtfailed") {
                        echo "<p>Noget gik galt.</p>";
                    }
                    else if ($_GET["error"] == "brugernavneksisterer") {
                        echo "<p>Brugernavnet eksistrer allerede.</p>";
                    }
                    else if ($_GET["error"] == "none") {
                        echo "<p>Registrering fuldført.</p>";
                    }
                }
                ?> 

            </section>

             

<?php
    include_once 'footer.php';
?>            
