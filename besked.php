<?php
    include_once 'header.php';
?>
            
            <section class="sebeskeder-section">
                <h1>Besked</h1>
                
                <?php
                    include "includes/dbh.inc.php"; // Her inkluderes databasen, da den skal bruges til at finde beskeder til brugeren.

                    if (isset($_GET["brugernavn"])) { // Hvis der står brugernavn i url'en.
                        $afsender_brugernavn = $_GET["brugernavn"];
                        $besked_id = $_GET["besked_id"];
                        
                        if($_GET["brugernavn"] == $afsender_brugernavn){ // Hvis sandt henter den kun beskederne for det brugernavn der er inputtet i søgefeltet.
                            $afsender_brugernavn = str_replace("'",'',$afsender_brugernavn);
                            $besked_id = str_replace("'",'',$besked_id);
                            $sql = "SELECT besked_indhold, afsender_brugernavn, tidspunkt FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id FROM besked_modtager WHERE besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."' AND besked.afsender_brugernavn = '". $afsender_brugernavn."' AND besked.besked_id = '".$besked_id."') ORDER BY tidspunkt DESC";
                            // ORDER BY tidspunkt DESC, sorterer efter nyeste beskeder først.
                        }
                    }

                    else { // Hvis der ikke er noget brugernavn, er brugeren ved en fejl kommet ind, og skal dirigeres tilbage.
                        header("location: ../sebeskeder.php?error=none");
                        exit();
                    }
                    
                    //$sql = "SELECT besked_indhold, afsender_brugernavn, tidspunkt FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id FROM besked_modtager WHERE besked_modtager.modtager_brugernavn = '".$_SESSION['brugernavn']."')";
                    $result = $conn->query($sql); // Her sender den sql strengen afsted og gemmer svaret i en variabel.
                    if ($result->num_rows > 0) { // Tjekker om antallet af rækker i resultatet er over 0. 
                        while ($row = $result->fetch_assoc()) { // Laver resultatet med rækker om til en array man kan håndtere og kører loopet indtil der ikke er flere elementer i array.
                            echo "<div id='beskedmodul'>
                                    <h2 id=afsender>Fra ".$row["afsender_brugernavn"]."</h2>
                                    <hr style='color:grey;'>
                                    <p id=beskedIndhold>".$row["besked_indhold"]."</p>
                                    <p id=beskedTidspunkt>".$row["tidspunkt"]."</p>
                                </div>";
                        }
                    }
                    else { // Hvis resultatet ($result) så er 0 eller under er brugeren ved en fejl kommet ind, og skal dirigeres tilbage.
                        header("location: ../sebeskeder.php?error=none");
                        exit();
                    }

                ?>

            </section>

<?php
    include_once 'footer.php';
?>
