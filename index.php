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
    
} catch (PDOException $e) {
    echo $e->getMessage();
}