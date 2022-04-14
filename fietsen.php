<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
          <?php
          include("connect.php");

          $stmt = $pdo->query("SELECT * FROM fiets_merk");

          if(isset($_POST['toevoegen'])){
              $merk_ID = $_POST['merk_ID'];
              $heren_dames_uni = $_POST['heren_dames_uni'];
              $maat = $_POST['maat'];
              $prijs = $_POST['prijs'];
              $fiets_serienummer = $_POST['fiets_serienummer'];
              
              $sql = "INSERT INTO klanten (merk_ID, heren_dames_uni, maat, prijs, fiets_serienummer)
              VALUES (?, ?, ?, ?, ?);";
              $pdo->prepare($sql)->execute([$merk_ID, $heren_dames_uni, $maat, $prijs, $fiets_serienummer]);
          }
          ?>

          <div class="Container">
        <h1 id="homepage_title">fietsen toevoegen</h1>
        <div class="table_div"> 
        <form action="index.php" method="post">
            <table border="1" width="500px">
                <tr>
                <td><label>ID_merk:</label></td>
                    <td><select name="ID_merk" id="ID_merk">
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
                    <td colspan="2" align="right"><input type="submit" value="toevoegen" name="toevoegen"></td>
                </tr>
            </table>
        </form>
</div>
    </body>
</html>