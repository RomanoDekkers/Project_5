<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
    <div class="table_div">
          <?php
          include("beheer.php");
          include("connect.php");

          $stmt = $pdo->query("SELECT * FROM fiets_merk");

          if(isset($_POST['toevoegen'])){
              $IDmerk = $_POST['merk'];
              $heren_dames_uni = $_POST['heren_dames_uni'];
              $maat = $_POST['maat'];
              $prijs = $_POST['prijs'];
              $fiets_serienummer = $_POST['fiets_serienummer'];
              $status = $_POST['status']; 
              $sql = "INSERT INTO fiets (IDmerk, heren_dames_uni, maat, prijs, fiets_serienummer, status)
              VALUES (?, ?, ?, ?, ?, ?);";
              $pdo->prepare($sql)->execute([$IDmerk, $heren_dames_uni, $maat, $prijs, $fiets_serienummer, $status]);
          }
          ?>

          <div class="Container">
        <h1>fietsen toevoegen</h1>
        <div class="table_div"> 
        <form action="fietsen.php" method="post">
            <table border="1" width="500px">
                <tr>
                <td><label>merk_ID:</label></td>
                    <td><select name="merk" id="merk">
                        <?php
                            foreach ($stmt as $rij){
                                echo "<option value=";
                                echo $rij['ID'];
                                echo ">";
                                echo $rij['merk_naam'];
                                echo "</option>";
                            }
                        ?>
                        </select></td>
                </tr>
                <tr>
                    <td><label>heren_dames_uni:</label></td>
                        <td><select name="heren_dames_uni" id="heren_dames_uni">
                            <option value="1">heren</option>
                            <option value="2">dames</option>
                            <option value="3">uni</option>
                        </select></td>
		        </tr>
                <tr>
                    <td>maat:</td>
                    <td><input type="text" placeholder="maat" name="maat"></td>
                </tr>
                <tr>
                    <td>prijs:</td>
                    <td><input type="text" placeholder="prijs" name="prijs"></td>
                </tr>
                <tr>
                    <td>serienummer fiets:</td>
                    <td><input type="text" placeholder="fiets_serienummer" name="fiets_serienummer"></td>
                </tr>
                <tr>
                <td><label>beschikbaarheid:</label></td>
                        <td><select name="status" id="status">
                            <option value="0">berschikbaar</option>
                            <option value="1">uitgeleend</option>
                            <option value="2">in onderhoud</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="submit" value="toevoegen" name="toevoegen"></td>
                </tr>
            </table>
        </form>
        <?php

if(isset($_POST)){
	if(isset($_POST['update'])){
	$naam = $_POST['naam'];
	$prijs = $_POST['prijs'];
	$id = $_POST['id'];
    $status = $_POST['status'];
	
	$sql = "UPDATE `fiets` SET `maat` = ?, `prijs` = ?, `status` = ? WHERE `fiets`.`ID` = ?;";
	$pdo->prepare($sql)->execute([$naam, $prijs, $status, $id]);
	}
}


if(isset($_GET['aktie'])){
        if($_GET['aktie'] == "verwijder"){
            $query = 'DELETE FROM `fiets` WHERE `ID` = ' .$_GET['id'];
            $pdo->query($query);        
        }


    if($_GET['aktie'] == "wijzigen"){
        $id = $_GET['id'];
            $stmt = $pdo->prepare("select maat as maat, prijs as prijs, status as status from fiets where ID = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch();

            echo "
            <form action='fietsen.php' method='POST' name='update'>
            <table border=1>
            <tr>
                <td>
                    Categorie
                </td>
                <td>
                    Maat
                </td>
                <td>
                    Prijs
                </td>
                <td>
                    Status
                </td>
                <td>
                    Update
                </td>

            </tr>
            <tr>
                <td>Categorie</td>
                <td>
                    <input type='text' name='naam' value='".$data['maat']."'>
                </td>
                <td>
                    <input type='text' name='prijs' value='".$data['prijs']."'>
                </td>
                <td>
                    <select name='status' value='".$data['status']."'>
                        <option value='0'>berschikbaar</option>
                        <option value='1'>uitgeleend</option>
                        <option value='2'>in onderhoud</option>
                </select></td><td>
                    <input type='hidden' name='id' value='".$id."'>
                    <input type='submit' name='update' value='Wijzig product'>
                </td>
            </tr>
            </form>
            
            ";
            exit;
        }
    }

        $tabelData = '<table border="1" width="700px"><tr>
            <td>ID</td>
            <td>ID Merk</td>
            <td>heren_dames_uni</td>
            <td>maat</td>
            <td>prijs</td>
            <td>fiets_serienummer</td>
            <td>Beschikbaarheid</td>
            <td colspan="2">Opties</td>
        </tr>';
            $stmt = $pdo->query("SELECT * FROM fiets");

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
                    $tabelData .= '<td>';
                        $tabelData .= $rij['status'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= '<a href="fietsen.php?aktie=wijzigen&id='.$rij['ID'].'">Update</a>';
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= '<a href="fietsen.php?aktie=verwijder&id='.$rij['ID'].'">Delete</a>';
                    $tabelData .= '</td>';
                    $tabelData .= '</tr>';
            }
            $tabelData .= '</table>';
            echo $tabelData;
        ?>
</div>
</div>
</div>
</body>
</html>