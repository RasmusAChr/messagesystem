<!-- Her bliver headeren inkluderet -->
<?php
    include_once 'header.php';
?>
            <!-- Login formularen som brugeren skal udfylde -->
            <section class="login-form">
                <h2>Login</h2>
                <form action="includes/login.inc.php" method="post"> <!-- Data som bliver sendt med method=post er gemt inde i HTTP forespørgslen. Bruges til sensitiv data. -->
                    <input type="text" name="brugernavn" placeholder="Brugernavn...">
                    <input type="password" name="password" placeholder="Kodeord..."> <!-- Type=password gør at der kommer prikker når man skriver -->
                    <button type="submit" name="submit">Login</button>
                </form>

                <?php
                if (isset($_GET["error"])) { // Tjekker om der kommer en fejl.
                    if($_GET["error"] == "emptyinput") { // Tjekker om fejlen skyldes manglende udfyldning.
                        echo "<p>Udfyld alle felter.</p>";
                    }
                    else if ($_GET["error"] == "wronglogin") { // Tjekker om fejlen skyldes et forkert login.
                        echo "<p>Ugyldig login oplsyninger.</p>";
                    }
                }
                ?> 

            </section>

<!-- Her bliver footeren inkluderet -->
<?php
    include_once 'footer.php';
?>            
