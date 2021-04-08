<?php
    include_once 'header.php';
?>
            
            <section class="login-form">
                <h2>Login</h2>
                <form action="includes/login.inc.php" method="post"> <!-- Forklar post -->
                    <input type="text" name="brugernavn" placeholder="Brugernavn...">
                    <input type="password" name="password" placeholder="Kodeord...">
                    <button type="submit" name="submit">Login</button>
                </form>

                <?php
                if (isset($_GET["error"])) {
                    if($_GET["error"] == "emptyinput") {
                        echo "<p>Udfyld alle felter.</p>";
                    }
                    else if ($_GET["error"] == "wronglogin") {
                        echo "<p>Ugyldig login oplsyninger.</p>";
                    }
                }
                ?> 

            </section>

<?php
    include_once 'footer.php';
?>            
