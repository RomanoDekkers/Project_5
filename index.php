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
                    <td>woonplaats:</td>
                    <td><input type="text" placeholder="woonplaats" name="woonplaats" required></td>
                </tr>
                <tr>
                    <td>postcode:</td>
                    <td><input type="text" placeholder="postcode" name="postcode" required></td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td><input type="text" placeholder="E_mail" name="E_mail" required></td>
                </tr>
                <tr>
                    <td>telefoon nummer:</td>
                    <td><input type="number" id="replyNumber" data-bind="value:replyNumber" placeholder="telefoon_nummer" name="telefoon_nummer"></td>
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