<?php
    include_once 'header.php';
?>
            
            <section class="sebeskeder-section">
                <h1>Send beskeder</h1>
                <p>På denne side kommer man til at kunne oprette beskeder</p>
                
                <form action="includes/sendbeskeder.inc.php" method="post"> <!-- Data som bliver sendt med method=post er gemt inde i HTTP forespørgslen. Bruges til sensitiv data. -->
                    <input type="text" name="modtager" placeholder="Modtager...">
                    <textarea id="beskedomraade" name="besked" rows="4" placeholder="Skriv din besked her..."></textarea>
                    <button type="submit" name="submit">Send</button>
                </form>

                <?php 
                    // php kode her
                ?>
               
            </section>

<?php
    include_once 'footer.php';
?>
