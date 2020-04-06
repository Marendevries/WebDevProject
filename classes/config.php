<?php
//connectToDatabaseAndClose.php
$host = "localhost";
$databaseName = "pokerDb";
$dns = "mysql:host=$host;dbname=$databaseName";
$username = "student";     //for mamp
$password = "student";     //for mamp

//default username, password for wamp is root, empty/blank

$pdo = null;

try {
    $pdo = new PDO($dns, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $ex) {
    echo "Connection failed:  $ex";
}
?>