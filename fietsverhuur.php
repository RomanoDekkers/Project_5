<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <h1>Start</h1> 
        <?php
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
                $tabelData .= '</tr>';
            }
            $tabelData .= '</table>';
            echo $tabelData;
        }
        ?>
    </body>
</html>