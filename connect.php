
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