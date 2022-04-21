<html>
    <head>
        <link rel="stylesheet" href="index.css">
        <title>fietsverhuur de elstar</title>
    </head>
    <body>
    <div class="Container"> 
    <div class="table_div">
<?php
include("connect.php");
if(isset($_POST)){
	if(isset($_POST['update'])){
	$naam = $_POST['naam'];
	$adres = $_POST['adres'];
    $woonplaats = $_POST['woonplaats'];
    $postcode = $_POST['postcode'];
    $Email = $_POST['e_mail'];
    $telefoonNummer = $_POST['telefoon_nummer'];
	$id = $_POST['id'];
	
	$sql = "UPDATE `klanten` SET `naam` = ?, `adres` = ?, `woonplaats` = ?, `postcode` = ?, `E_mail` = ?, `telefoon_nummer`= ? WHERE `klanten`.`ID` = ?;";
	$pdo->prepare($sql)->execute([$naam, $adres, $woonplaats, $postcode, $Email, $telefoonNummer, $id]);
	}
}
    if(isset($_GET['aktie'])){
        if($_GET['aktie'] == "verwijder"){
            $query = 'DELETE FROM `klanten` WHERE `ID` = ' .$_GET['id'];
            $pdo->query($query);
        }
    

    if($_GET['aktie'] == "wijzigen"){
        $id = $_GET['id'];
            $stmt = $pdo->prepare("select naam as naam, adres as adres, woonplaats as woonplaats, postcode as postcode, e_mail as e_mail, telefoon_nummer as telefooon_nummer from klanten where ID = ?");
            $stmt->execute([$id]);
            $data = $stmt->fetch();

            echo "
            <form action='klanten.php' method='POST' name='update'>
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
                    Woonplaats
                </td>
                <td>
                    Postcode
                </td>
                <td>
                    E-Mail
                </td>
                <td>
                    Telefoon Nummer
                </td>
                <td>
                    Update
                </td>
            </tr>
            <tr>
                <td>Categorie</td>
                <td>
                    <input type='text' name='naam' value='".$data['naam']."'>
                </td>
                <td>
                    <input type='text' name='adres' value='".$data['adres']."'>
                </td>
                <td>
                    <input type='text' name='woonplaats' value='".$data['woonplaats']."'>
                </td>
                <td>
                    <input type='text' name='postcode' value='".$data['postcode']."'>
                </td>
                <td>
                    <input type='text' name='email' value='".$data['E_mail']."'>
                </td>
                <td>
                    <input type='text' name='telefoon_nummer' value='".$data['telefoon_nummer']."'>
                </td>
                <td>
                    <input type='hidden' name='id' value='".$id."'>
                    <input type='submit' name='update' value='Wijzig product'>
                </td>
            </tr>
            </form>
            
            ";
            exit;
        }
    }

        echo "<h1 id='homepage_title'>Klanten Informatie</h1>";

          $tabelData = '<table border="1" width="700px"><tr>
          <td>ID</td>
          <td>Naam</td>
          <td>Adres</td>
          <td>Woonplaats</td>
          <td>Postcode</td>
          <td>E_mail</td>
          <td>Telefoon Nummer</td>
          <td>Beschikbaarheid</td>
          <td colspan="2">Opties</td>
      </tr>';
          $stmt = $pdo->query("SELECT * FROM klanten");

          foreach ($stmt as $rij){
              $tabelData .= '<tr>';
                  $tabelData .= '<td>';
                      $tabelData .= $rij['ID'];
                  $tabelData .= '</td>';
                  $tabelData .= '<td>';
                      $tabelData .= $rij['naam'];
                  $tabelData .= '</td>';
                  $tabelData .= '<td>';
                      $tabelData .= $rij['adres'];
                  $tabelData .= '</td>';
                  $tabelData .= '<td>';
                      $tabelData .= $rij['woonplaats'];
                  $tabelData .= '</td>';
                  $tabelData .= '<td>';
                      $tabelData .= $rij['postcode'];
                  $tabelData .= '</td>';
                  $tabelData .= '<td>';
                      $tabelData .= $rij['E_mail'];
                  $tabelData .= '</td>';
                  $tabelData .= '<td>';
                      $tabelData .= $rij['telefoon_nummer'];
                  $tabelData .= '</td>';
                  $tabelData .= '<td>';
                      $tabelData .= '<a href="klanten.php?aktie=wijzigen&id='.$rij['ID'].'">Update</a>';
                  $tabelData .= '</td>';
                  $tabelData .= '<td>';
                      $tabelData .= '<a href="klanten.php?aktie=verwijder&id='.$rij['ID'].'">Delete</a>';
                  $tabelData .= '</td>';
                  $tabelData .= '</tr>';
          }
          $tabelData .= '</table>';
          echo $tabelData;
          ?>
</div>
        </div>
    </body>
</html>