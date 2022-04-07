<html>
    <head>
        <title>fietsverhuur de elstar</title>
    </head>
    <body>
          <h1>Start</h1> 
          <?php
            include("connect.php")
            
            $stmt = $pdo->query("INSERT INTO klanten (naam, adres, woonplaats, postcode, E_mail, telefoon_nummer)
            VALUES ('test_naam', 'test_adres', 'cuijk', '5387hi', 'test@test.com', '0612345678')");
        ?>
    </body>
</html>