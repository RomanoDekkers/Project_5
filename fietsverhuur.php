<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
    <div class="table_div">
        <?php
        session_start();
        include("beheer.php");
            include("connect.php");
            $stmt = $pdo->query("SELECT * FROM fiets_merk");
            echo ' <form action="fietsverhuur.php" method="post">';
            echo '<td><label>filter merk:</label></td>
                    <td><select name="merk" id="merk">';
                            foreach ($stmt as $rij){
                                echo "<option value=";
                                echo $rij['ID'];
                                echo ">";
                                echo $rij['merk_naam'];
                                echo "</option>";
                            }
                        echo '</select></td>
                        <br/>';
                        
            echo '<td><label>filter soort fiets:</label></td>
                        <td><select name="soort" id="soort">';
                        echo '<option value="1">heren</option>';
                        echo '<option value="2">dames</option>';
                        echo '<option value="2">uni</option>';
                        echo '</select></td>';

                echo '<br/>
                        <tr>
                        <td colspan="2" align="right"><input type="submit" value="toevoegen" name="toevoegen"></td>
                    </tr>';
            echo "</form>";

            if(isset($_POST['toevoegen'])){
                $stmt = $pdo->query("SELECT * FROM fiets where IDmerk = ". $_POST['merk']. " AND heren_dames_uni =". $_POST['soort']);

            $tabelData = '<table border="1" width="500px"><tr>
            <td>ID</td>
            <td>merk_ID</td>
            <td>heren_dames_uni</td>
            <td>maat</td>
            <td>prijs</td>
            <td>fiets_serienummer</td>
            <td colspan="2">opties</td>
        </tr>';
            
            foreach ($stmt as $rij){
                $tabelData .= '<tr>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['ID'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['IDmerk'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['heren_dames_uni'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['maat'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['prijs'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['fiets_serienummer'];
                    $tabelData .= '</td>';
                        if($rij['status'] == 0){
                            $tabelData .= "<td><a href='fietsverhuur.php?aktie=verhuren&id=".$rij['ID']."'>verhuren</a></td>";
                        }
                        if($rij['status'] == 1){
                            $tabelData .="<td><a href='fietsverhuur.php?aktie=teruggebracht&id=".$rij['ID']."'>teruggebracht</a></td>";
                        }
                $tabelData .= '</tr>';
            }
            $tabelData .= '</table>';
            echo $tabelData;
        }
        if(ISSET($_GET['aktie']))
        {
            if($_GET['aktie'] == "verhuren") {
                $ID = $_GET['id'];
                echo "<form action='fietsverhuur.php?aktie=verhuren&id=". $ID ."' method='post'>";
                    echo '<table border="1" width="500px">
                        <tr>
                            <td>E-mail:</td>
                            <td><input type="text" placeholder="E_mail" name="E_mail" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right"><input type="submit" value="versturen naar database" name="klant"></td>
                        </tr>
                    </table>
                </form>';
                if(isset($_POST['klant'])){
                    $mail = "'";
                    $mail .= $_POST['E_mail'];
                    $mail .= "'";
                    $stmt = $pdo->query("SELECT * FROM klanten where E_mail = " .$mail);
                    foreach ($stmt as $rij){
                        $klantID = $rij['ID'];
                    }
                    $sql = "INSERT INTO fietsen_verhuur (datum_uitgeleend, datum_teruggebracht, klant_ID, fiets_ID)
                    VALUES (?, ?, ?, ?);";
                    $pdo->prepare($sql)->execute([date("Y/m/d"), null, $klantID, $ID]);
                    $stmt = $pdo->query("SELECT * FROM fietsen_verhuur where klant_ID = " .$klantID);
                    foreach ($stmt as $rij){
                        $fietsID = $rij['fiets_ID'];
                    }
                    $stmt = $pdo->query("UPDATE `fiets` SET `status` = '1' WHERE `fiets`.`ID` = $fietsID");
                    header("Location:fietsverhuur.php");
                    }
            }
            if($_GET['aktie'] == "teruggebracht") {
                $ID = $_GET['id'];
                echo "<form action='fietsverhuur.php?aktie=teruggebracht&id=". $ID ."' method='post'>";
                    echo '<table border="1" width="500px">
                        <tr>
                            <td>E-mail:</td>
                            <td><input type="text" placeholder="E_mail" name="E_mail" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right"><input type="submit" value="versturen naar database" name="terug"></td>
                        </tr>
                    </table>
                </form>';
                if(isset($_POST['terug'])){
                    $mail = "'";
                    $mail .= $_POST['E_mail'];
                    $mail .= "'";
                    $_SESSION['E_mail'] = $mail;
                    $stmt = $pdo->query("SELECT * FROM klanten where E_mail = " .$mail);
                    foreach ($stmt as $rij){
                        $klantID = $rij['ID'];
                    }
                    $stmt = $pdo->query("SELECT * FROM fietsen_verhuur where klant_ID = " .$klantID);
                    $tabelData = '<table border="1" width="500px"><tr>
                        <td>ID</td>
                        <td>datum_uitgeleend</td>
                        <td>datum_teruggebracht</td>
                        <td>klant_ID</td>
                        <td>fiets_ID</td>
                        <td colspan="2">opties</td>
                    </tr>';
                    foreach ($stmt as $rij){
                        $tabelData .= '<tr>';
                            $tabelData .= '<td>';
                                $tabelData .= $rij['ID'];
                            $tabelData .= '</td>';
                            $tabelData .= '<td>';
                                $tabelData .= $rij['datum_uitgeleend'];
                            $tabelData .= '</td>';
                            $tabelData .= '<td>';
                                $tabelData .= $rij['datum_teruggebracht'];
                            $tabelData .= '</td>';
                            $tabelData .= '<td>';
                                $tabelData .= $rij['klant_ID'];
                            $tabelData .= '</td>';
                            $tabelData .= '<td>';
                                $tabelData .= $rij['fiets_ID'];
                            $tabelData .= '</td>';
                                $tabelData .= "<td><a href='fietsverhuur.php?aktie=terug_versturen&id=".$rij['ID']."'>versturen naar database</a></td>";
                        $tabelData .= '</tr>';
                    }
                    $tabelData .= '</table>';
                    echo $tabelData;
                }
            }
            if($_GET['aktie'] == 'terug_versturen') {
                $mail = $_SESSION['E_mail'];
                $stmt = $pdo->query("SELECT * FROM klanten where E_mail = " .$mail);
                foreach ($stmt as $rij){
                    $klantID = $rij['ID'];
                }
                $stmt = $pdo->query("SELECT * FROM fietsen_verhuur where klant_ID = " .$klantID);
                $date = "'";
                $date .= date("Y-m-d");
                $date .= "'";
                $stmt = $pdo->query("UPDATE `fietsen_verhuur` SET `datum_teruggebracht`= ". $date . " WHERE `fietsen_verhuur`.`klant_ID` = ". $klantID);
                $stmt = $pdo->query("SELECT * FROM fietsen_verhuur where klant_ID = " .$klantID);
                foreach ($stmt as $rij){
                    $fietsID = $rij['fiets_ID'];
                }
                $stmt = $pdo->query("UPDATE `fiets` SET `status` = '0' WHERE `ID` =". $fietsID);
                //header("Location:fietsverhuur.php");
                }
        }
        ?>
    </body>
</html>