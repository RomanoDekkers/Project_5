<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
<div class="Container">
        <h1 id="homepage_title">Fietsverhuur de Elstar</h1>
        <div class="table_div"> 
        <form action="index.php" method="post">
            <table width="500px">
                <tr>
                    <td class="index">Naam:</td>
                    <td><input type="text" placeholder="Naam" name="naam" required></td>
                </tr>
                <tr>
                    <td class="index">Adres:</td>
                    <td><input type="text" placeholder="Adres" name="adres" required></td>
		        </tr>
                <tr>
                    <td class="index">Woonplaats:</td>
                    <td><input type="text" placeholder="Woonplaats" name="woonplaats" required></td>
                </tr>
                <tr>
                    <td class="index">Postcode:</td>
                    <td><input type="text" placeholder="Postcode" name="postcode" required></td>
                </tr>
                <tr>
                    <td class="index">E-mail:</td>
                    <td><input type="text" placeholder="E-Mail" name="E_mail" required></td>
                </tr>
                <tr>
                    <td class="index">Telefoon Nummer:</td>
                    <td><input type="number" id="replyNumber" data-bind="value:replyNumber" placeholder="Telefoon Nummer" name="telefoon_nummer"></td>
                </tr>
                <tr>
                    <td colspan="2" align="right"><input type="submit" id="btnSubmit" value="Registreer" name="toevoegen"></td>
                </tr>
            </table>
        </form>
</div>
        <?php
            include("connect.php");

            if(isset($_POST['toevoegen'])){
                $naam = $_POST['naam'];
                $adres = $_POST['adres'];
                $woonplaats = $_POST['woonplaats'];
                $postcode = $_POST['postcode'];
                $E_mail = $_POST['E_mail'];
                $telefoon_nummer = $_POST['telefoon_nummer'];
                
                $sql = "INSERT INTO klanten (naam, adres, woonplaats, postcode, E_mail, telefoon_nummer)
                VALUES (?, ?, ?, ?, ?, ?);";
                $pdo->prepare($sql)->execute([$naam, $adres, $woonplaats, $postcode, $E_mail, $telefoon_nummer]);
            }
        ?>
</div>
    </body>
</html>