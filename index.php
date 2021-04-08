<?php
    include_once 'header.php';
?>
            
            <section class="index-intro">
                <h1>Startside</h1>
                <p>Dette er en ret nice side som skal vise en loginsystem - wuhu.</p>

                <?php
                    if (isset($_SESSION["brugernavn"])) {
                        echo "<p>Hej med dig " . $_SESSION["fornavn"] . ".</p>";
                    }
                    else {
                        echo "<p>Du er ikke logget ind.</p>";
                    }
                ?>

            </section>

<?php
    include_once 'footer.php';
?>            
