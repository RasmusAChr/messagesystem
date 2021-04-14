<?php
    include_once 'header.php';
?>
            
            <section class="sebeskeder-section">
                <h1>Se beskeder</h1>
                <p>På denne sider kommer beskeder til at være (≧∇≦)ﾉ</p>
                
                <?php
                    include "includes/dbh.inc.php"; // Her inkluderes databasen, da den skal bruges til at finde beskeder til brugeren.

                    // Nedenstående er en SQL streng, som finder alle beskederne som er til den bruger der er logget ind. 
                    $sql = "SELECT besked_indhold, afsender_brugernavn FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id from besked_modtager where besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."')";
                    $result = $conn->query($sql); // Her sender den sql strengen afsted og gemmer svaret i en variabel.
                    if ($result->num_rows > 0) { // Tjekker om antallet af rækker i resultatet er over 0. 
                        while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.

                            echo "<div id='beskedmodul'> <h2>Afsender: ".$row["afsender_brugernavn"]."</h2><p>".$row["besked_indhold"]."</p></div>";
                        }
                    }
                    else { // Hvis resultatet ($result) så er 0 eller under.
                        echo "<p>Du har ingen beskeder.</p>";
                    }

                ?>

            </section>

<?php
    include_once 'footer.php';
?>            
