<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
<div class="Container">
        <h1 id="homepage_title">Fietsverhuur de Elstar</h1>
        <div class="table_div"> 
        <form action="medewerkers.php" method="post">
            <table border="1" width="500px">
                <tr>
                    <td>naam:</td>
                    <td><input type="text" placeholder="naam" name="naam" required></td>
                </tr>
                <tr>
                    <td>adres:</td>
                    <td><input type="text" placeholder="adres" name="adres" required></td>
		        </tr>
                <tr>
                    <td>postcode:</td>
                    <td><input type="text" placeholder="postcode" name="postcode" required></td>
                </tr>
                <tr>
                    <td>woonplaats:</td>
                    <td><input type="text" placeholder="woonplaats" name="woonplaats" required></td>
                </tr>
                <tr>
                    <td>Salaris:</td>
                    <td><input type="text" placeholder="Salaris" name="Salaris" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="submit" value="toevoegen" name="toevoegen"></td>
                </tr>
            </table>
        </form>
</div>
        <?php
            include("connect.php");

            if(isset($_POST['toevoegen'])){
                $naam = $_POST['naam'];
                $adres = $_POST['adres'];
                $postcode = $_POST['postcode'];
                $woonplaats = $_POST['woonplaats'];
                $Salaris = $_POST['Salaris'];
                
                $sql = "INSERT INTO medewerkers (Naam, Adres, Postcode, Woonplaats, Salaris)
                VALUES (?, ?, ?, ?, ?);";
                $pdo->prepare($sql)->execute([$naam, $adres, $postcode, $woonplaats, $Salaris]);
            }
        ?>
</div>
    </body>
</html>