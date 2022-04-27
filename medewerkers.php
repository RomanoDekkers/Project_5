<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
    <div class="table_div">
<?php 
    include("beheer.php");
?>
<div class="Container">
        <h1>Fietsverhuur de Elstar</h1>
        <div class="table_div"> 
        <form action="medewerkers.php" method="post">
            <table border="1" width="500px">
                <tr>
                    <td>naam:</td>
                    <td><input type="text" placeholder="Naam" name="Naam" required></td>
                </tr>
                <tr>
                    <td>adres:</td>
                    <td><input type="text" placeholder="Adres" name="Adres" required></td>
		        </tr>
                <tr>
                    <td>postcode:</td>
                    <td><input type="text" placeholder="Postcode" name="Postcode" required></td>
                </tr>
                <tr>
                    <td>woonplaats:</td>
                    <td><input type="text" placeholder="Woonplaats" name="Woonplaats" required></td>
                </tr>
                <tr>
                    <td>Salaris:</td>
                    <td><input type="text" placeholder="Salaris" name="Salaris" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="submit" value="Toevoegen" name="Toevoegen"></td>
                </tr>
            </table>
        </form>
</div>
        <?php
            include("connect.php");

            if(isset($_POST['Toevoegen'])){
                $Naam = $_POST['Naam'];
                $Adres = $_POST['Adres'];
                $Postcode = $_POST['Postcode'];
                $Woonplaats = $_POST['Woonplaats'];
                $Salaris = $_POST['Salaris'];
                
                $sql = "INSERT INTO medewerkers (Naam, Adres, Postcode, Woonplaats, Salaris)
                VALUES (?, ?, ?, ?, ?);";
                $pdo->prepare($sql)->execute([$Naam, $Adres, $Postcode, $Woonplaats, $Salaris]);
            }


            if(isset($_POST)){
                if(isset($_POST['Update'])){
                $Naam = $_POST['Naam'];
                $Adres = $_POST['Adres'];
                $Postcode = $_POST['Postcode'];
                $Woonplaats = $_POST['Woonplaats'];
                $Salaris = $_POST['Salaris'];
                $ID = $_POST['ID'];
                
                $sql = "UPDATE `medewerkers` SET `Naam` = ?, `Adres` = ?, `Postcode` = ?, `Woonplaats` = ?, `Salaris` = ? WHERE `medewerkers`.`ID` = ?;";
                $pdo->prepare($sql)->execute([$Naam, $Adres, $Postcode, $Woonplaats, $Salaris, $ID]);
                }
            }


            if(isset($_GET['aktie'])){
                if($_GET['aktie'] == "Verwijder"){
                    $query = 'DELETE FROM `medewerkers` WHERE `ID` = ' .$_GET['ID'];
                    $pdo->query($query);
                }

                if($_GET['aktie'] == "Wijzigen"){
                    $id = $_GET['ID'];
                        $stmt = $pdo->prepare("select Naam as Naam, Adres as Adres, Postcode as Postcode, Woonplaats as Woonplaats, Salaris as Salaris from medewerkers where ID = ?");
                        $stmt->execute([$id]);
                        $data = $stmt->fetch();
            
                        echo "
                        <form action='medewerkers.php' method='POST' name='update'>
                        <table border=1>
                        <tr>
                            <td>
                                Categorie
                            </td>
                            <td>
                                Naam
                            </td>
                            <td>
                                Adres
                            </td>
                            <td>
                                Postcode
                            </td>
                            <td>
                                Woonplaats
                            </td>
                            <td>
                                Salaris
                            </td>
                            <td>
                                Update
                            </td>
                        </tr>
                        <tr>
                            <td>Categorie</td>
                            <td>
                                <input type='text' name='Naam' value='".$data['Naam']."'>
                            </td>
                            <td>
                                <input type='text' name='Adres' value='".$data['Adres']."'>
                            </td>
                            <td>
                                <input type='text' name='Postcode' value='".$data['Postcode']."'>
                            </td>
                            <td>
                                <input type='text' name='Woonplaats' value='".$data['Woonplaats']."'>
                            </td>
                            <td>
                                <input type='text' name='Salaris' value='".$data['Salaris']."'>
                            </td>
                            <td>
                                <input type='hidden' name='ID' value='".$id."'>
                                <input type='submit' name='Update' value='Wijzig product'>
                            </td>
                        </tr>
                        </form>
                        
                        ";
                        exit;
                    }
            }

            $tabelData = '<table border="1" width="700px"><tr>
            <td>ID</td>
            <td>Naam</td>
            <td>Adres</td>
            <td>Postcode</td>
            <td>Woonplaats</td>
            <td>Salaris</td>
            <td colspan="2">Opties</td>
        </tr>';
            $stmt = $pdo->query("SELECT * FROM medewerkers");
  
            foreach ($stmt as $rij){
                $tabelData .= '<tr>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['ID'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['Naam'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['Adres'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['Postcode'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['Woonplaats'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['Salaris'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= '<a href="medewerkers.php?aktie=Wijzigen&ID='.$rij['ID'].'">Update</a>';
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= '<a href="medewerkers.php?aktie=Verwijder&ID='.$rij['ID'].'">Delete</a>';
                    $tabelData .= '</td>';
                    $tabelData .= '</tr>';
            }
            $tabelData .= '</table>';
            echo $tabelData;

        ?>
</div>
    </body>
</html>