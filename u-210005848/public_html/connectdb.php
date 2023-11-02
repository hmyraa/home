<?php
    $dbhost = 'localhost';
    $dbname = 'u_210005848_db';
    $username = 'u-210005848';
    $password = 'Tg73QlLuI9NSn51';
    $email = '';

    try {
        $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);
    } catch(PDOexception $exc) {
        echo("Failed to connect to database. <br>");
        echo($exc->getMessage());
        exit;
    }
?>