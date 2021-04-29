<?php
    include_once 'header.php';
?>
            
            <section class="sebeskeder-section">
                <h1>Se beskeder</h1>

                <!-- Laver kanppen til søgefunktionen -->
                <form action="includes/sebeskeder.inc.php" method="post"> <!-- Data som bliver sendt med method=post er gemt inde i HTTP forespørgslen. Bruges til sensitiv data. -->
                    <input id="søgBruger" type="text" name="brugernavn" placeholder="Søg efter bruger...">
                    <button type="submit" name="submit">Søg</button>
                </form>
                
                <?php
                    include "includes/dbh.inc.php"; // Her inkluderes databasen, da den skal bruges til at finde beskeder til brugeren.

                    if (isset($_GET["brugernavn"])) {
                        $afsender_brugernavn = $_GET["brugernavn"];
                        
                        if($_GET["brugernavn"] == $afsender_brugernavn){
                            $sql = "SELECT besked_indhold, afsender_brugernavn, tidspunkt FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id FROM besked_modtager WHERE besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."' AND besked.afsender_brugernavn = ". $afsender_brugernavn.")";
                        }
                    }

                    else { //hvis der ikke er indtastet et brugernavn
                        $sql = "SELECT besked_indhold, afsender_brugernavn, tidspunkt FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id FROM besked_modtager WHERE besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."') ORDER BY tidspunkt DESC";
                    }
                    
                    //$sql = "SELECT besked_indhold, afsender_brugernavn, tidspunkt FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id FROM besked_modtager WHERE besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."')";
                    $result = $conn->query($sql); // Her sender den sql strengen afsted og gemmer svaret i en variabel.
                    if ($result->num_rows > 0) { // Tjekker om antallet af rækker i resultatet er over 0. 
                        while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.

                            echo "<div id='beskedmodul'>
                                    <h2 id=afsender>".$row["afsender_brugernavn"]."</h2>
                                    <hr>
                                    <p id=beskedIndhold>".$row["besked_indhold"]."</p>
                                    <p id=beskedTidspunkt>".$row["tidspunkt"]."</p>
                                </div>";
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
