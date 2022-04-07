<html>
    <head>
        <title>fietsverhuur de elstar</title>
    </head>
    <body>
          <h1>Start</h1> 
          <?php
            $dbServername = "127.0.0.1:3307";
            $dbUsername = "root";
            $dbPasword = "";
            $dbname = "fiets_verhuur_de_elstar";
            $charset = 'utf8mb4';
            $conn = mysqli_connect("$dbServername", "$dbUsername", "$dbPasword", "$dbname");

            $dsn = "mysql:host=$dbServername;dbname=$dbname;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $pdo = new PDO($dsn, $dbUsername, $dbPasword, $options);
            } 
            catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }

            $stmt = $pdo->query("INSERT INTO klanten (naam, adres, woonplaats, postcode, E_mail, telefoon_nummer)
            VALUES ('test_naam', 'test_adres', 'cuijk', '5387hi', 'test@test.com', '0612345678')");
        ?>
    </body>
</html>