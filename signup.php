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
                    
                    // Tjekker om fejlen skyldes manglende udfyldning.
                    if($_GET["error"] == "emptyinput") { 
                        echo "<p>Udfyld alle felter.</p>";
                    }

                    // Tjekker om fejlen skyldes et forkert brugernavn.
                    else if ($_GET["error"] == "invalidbrugernavn") { 
                        echo "<p>Ugyldigt brugernavn</p>";
                    }

                    // Tjekker om fejlen skyldes at kodeordet er forkert.
                    else if ($_GET["error"] == "passworddontmatch") { 
                        echo "<p>Kodeord stemmer ikke overens.</p>";
                    }
                    // Tjekker om fejlen skyldes en fejl i et prepared statement
                    else if ($_GET["error"] == "stmtfailed") { 
                        echo "<p>Noget gik galt.</p>";
                    }

                    // Tjekker om fejlen skyldes at brugernavnet allerede eksisterer.
                    else if ($_GET["error"] == "brugernavneksisterer") { 
                        echo "<p>Brugernavnet eksistrer allerede.</p>";
                    }
                    
                    // Ingen fejl.
                    else if ($_GET["error"] == "none") { 
                        echo "<p>Registrering fuldført.</p>";
                    }
                }
                ?> 

            </section>

             

<?php
    include_once 'footer.php';
?>            
