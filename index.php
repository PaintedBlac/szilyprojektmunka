<?php
include 'login.php';
$dbname = "users";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //ATTR_ERRMODE->hibakeresés, ERRMODE_EXCEPTION->kivételkezelés

    $sql = "CREATE TABLE IF NOT EXISTS users(
    id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    password CHAR(60) NOT NULL,
    reg_date TIMESTAMP)";
    $pdo->exec($sql);

    $sql = "SELECT * FROM PDO2022";
    $record = $pdo->prepare($sql); //Prepare kb ugyanaz mint az execute viszont nem futtatja még le csak megnézi hogy futtatható e
    $record->execute();
    $tableToDescribe = "PDO2022";
    $statement = $pdo->query('DESCRIBE ' . $tableToDescribe);
    $r = $statement->fetchAll(PDO::FETCH_ASSOC); //az összes oszlop adataink bekerülnek az r-be

    echo "<table border=1> <tr>";
    foreach ($r as $column) {
        // print_r($column);
        echo "<th>" . $column["Field"] . "</th>";
    }
    $record = $pdo->query($sql); //A recordban eddig a fejléc volt most már az adataink kerülnek bele . Lehet exec-el is de akkor nem kell a setFetchMode
    $record->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $record->fetch()) {
        echo "<tr>";
        //primitív megoldás:
        // echo "<td>" . htmlspecialchars($row['id']) . "</td>"; //htmlspecialchars() -> speciális függvény ami leveszi az összes fölösleges speciális karaktert
        // echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        // echo "<td>" . htmlspecialchars($row['text']) . "</td>";
        // echo "<td>" . htmlspecialchars($row['reg_date']) . "</td>";

        //Programozóbb megoldás
        echo "</tr>";
        foreach ($row as $column) {
            echo "<td>" . htmlspecialchars($column) . "</td>";
        }
        echo "</tr>";
    }
    echo "</tr> </table>";

    // $pdo->exec($sql);
} catch (PDOException $e) {
    echo $e->getMessage();
}