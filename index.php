<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
<div class="container">
          <h1 id="homepage_title">fietsverhuur De Elstar</h1> 
          <form action="index.php" method="post">
        <div class="table_div">
          <table border="1" width="500px">
        <tr>
            <td>
                 Naam:
            </td>
            <td>
                <input type="text" placeholder="naam" name="naam">
            </td>
        </tr>
        <tr>
            <td>
                 Adres:
            </td>
            <td>
                <input type="text" placeholder="adres" name="adres">
            </td>
		</tr>
        <tr>
            <td>
                 Woonplaats:
            </td>
            <td>
                <input type="text" placeholder="woonplaats" name="woonplaats">
            </td>
        </tr>
        <tr>
            <td>
                 Postcode:
            </td>
            <td>
                <input type="text" placeholder="postcode" name="postcode">
            </td>
        </tr>
        <tr>
            <td>
                 E-mail:
            </td>
            <td>
                <input type="text" placeholder="E_mail" name="E_mail">
            </td>
        </tr>
        <tr>
            <td>
                 Telefoon nummer:
            </td>
            <td>
                <input type="text" placeholder="telefoon_nummer" name="telefoon_nummer">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit" value="toevoegen" name="toevoegen"></td>
        </tr>
    </table>
        </div>
</form>
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