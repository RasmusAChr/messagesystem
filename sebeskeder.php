<?php
    include_once 'header.php';
?>
            
            <section class="index-intro">
                <h1>Se beskeder</h1>
                <p> O/ På denne sider kommer beskeder til at være (≧∇≦)ﾉ</p>

                <!-- html tekstbox -->
                <!-- <textarea name="myTextBox" cols="50" rows="5"></textarea> -->
                
                <?php
                    include "includes/dbh.inc.php";

                    // $_SESSION['brugernavn']
                    $sql = "SELECT besked_indhold, afsender_brugernavn FROM besked WHERE besked.besked_id in (SELECT besked_modtager.besked_id from besked_modtager where besked_modtager.modtager_brugernavn = 'jacobz');";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            //echo "<p1>Afsender: </p1>".$row["afsender_brugernavn"]."<br>".$row["besked_indhold"]."<br>"."<br>";
                            echo "<div id='beskedmodul'> <h2>Afsender: ".$row["afsender_brugernavn"]."</h2><p>".$row["besked_indhold"]."</p></div>";
                        }
                    }

                ?>

            </section>

<?php
    include_once 'footer.php';
?>
