<?php
include 'login.php';
$dbname = "users";

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //ATTR_ERRMODE->hibakeresés, ERRMODE_EXCEPTION->kivételkezelés
    
    $sql = "CREATE DATABASE IF NOT EXISTS projekt_adatbazis"; //Létrehozom az adatbázis, ha még nem lenne meg.
    $pdo->exec($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS projekt_adatbazis.users( 
    id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    password CHAR(60) NOT NULL,
    reg_date TIMESTAMP)";
    $pdo->exec($sql); //Létrehozom az users táblát, ha még nem lenne meg.
    echo '
    <!DOCTYPE html>
    <html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Bejelentkezés</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,700">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
    <div class="login-form">
        <form method="post" action="">
            <h1>Bejelentkezés</h1>
            <div class="content">
                <div class="input-field">
                    <input type="email" placeholder="Email" name="email" id="email">
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Jelszó" name="password" id="password">
                </div>
                <a href="#" class="link">Elfelejtetted a jelszavad?</a>
            </div>
            <div class="action">                
                <button type="submit" name="login">Bejelentkezés</button>
                <button>Regisztráció</button>
            </div>
        </form>
    </div>
           
    </body>
    </html>';  
  
$email = $_POST["email"];
$options = ['cost' => 12,];
$password = password_hash($_POST["password"], PASSWORD_BCRYPT, $options); //A jelszót hashelem

echo $email;
echo '<br>';
echo $password;
    
} catch (PDOException $e) {
    echo $e->getMessage();
}