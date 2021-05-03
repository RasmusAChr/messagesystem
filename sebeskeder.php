<?php
    include_once 'header.php';
?>
            
            <section class="sebeskeder-section">
                <h1>Se beskeder</h1>

                <!-- Laver knappen og feltet til søgefunktionen -->
                <form action="includes/sebeskeder.inc.php" method="post"> <!-- Data som bliver sendt med method=post er gemt inde i HTTP forespørgslen. Bruges til sensitiv data. -->
                    <input id="søgBruger" type="text" name="brugernavn" placeholder="Søg efter bruger...">
                    <button id="søg" type="submit" name="submit">Søg</button>
                </form>
                
                <?php
                    include "includes/dbh.inc.php"; // Her inkluderes databasen, da den skal bruges til at finde beskeder til brugeren.

                    if (isset($_GET["brugernavn"])) { // Hvis der er skrevet noget i søgefeltet henter den brugernavnet i variablen $afsender_brugernavn.
                        $afsender_brugernavn = $_GET["brugernavn"];
                        
                        if($_GET["brugernavn"] == $afsender_brugernavn){ // Hvis sandt henter den kun beskederne for det brugernavn der er inputtet i søgefeltet.
                            $afsender_brugernavn = str_replace("'",'',$afsender_brugernavn);
                            $sql = "SELECT besked_id, besked_indhold, afsender_brugernavn, tidspunkt FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id FROM besked_modtager WHERE besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."' AND besked.afsender_brugernavn LIKE '%". $afsender_brugernavn."%') ORDER BY tidspunkt DESC";
                            // ORDER BY tidspunkt DESC, sorterer efter nyeste beskeder først.
                        }
                    }

                    else { //hvis der ikke er indtastet et brugernavn
                        $sql = "SELECT besked_id, besked_indhold, afsender_brugernavn, tidspunkt FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id FROM besked_modtager WHERE besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."') ORDER BY tidspunkt DESC";
                        // ORDER BY tidspunkt DESC, sorterer efter nyeste beskeder først.
                    }
                    
                    //$sql = "SELECT besked_indhold, afsender_brugernavn, tidspunkt FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id FROM besked_modtager WHERE besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."')";
                    $result = $conn->query($sql); // Her sender den sql strengen afsted og gemmer svaret i en variabel.
                    if ($result->num_rows > 0) { // Tjekker om antallet af rækker i resultatet er over 0. 
                        while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.
                            $url = "besked.php?brugernavn=".$row["afsender_brugernavn"]."&besked_id=".$row["besked_id"]."";
                            $besked_indhold = $row["besked_indhold"]; // Gemmer beskedens indhold i en variabel.
                            $besked_indhold = substr($besked_indhold,0,20); // Laver variablen om således man kun kan se 20 tegn.
                            echo "<a href=$url><div id='beskedmodul'>
                                    <h2 id=afsender>".$row["afsender_brugernavn"]."</h2>
                                    <hr style='color:grey;'>
                                    <p id=beskedIndhold>".$besked_indhold."...</p>
                                    <p id=beskedTidspunkt>".$row["tidspunkt"]."</p>
                                </div></a>";
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
