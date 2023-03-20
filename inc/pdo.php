<?php
/*
* Connexion à la base de donnée
*/
$dsn = 'mysql:host=localhost;dbname=astronomie';
$useDbName = 'stelian';
$userDbPassword = '12345';

try {
    $conn = new PDO(
        $dsn,
        $useDbName,
        $userDbPassword,
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ]
    );
} catch (PDOException $erreur) {
    echo 'Erreur de connexion: ' . $erreur->getMessage();
    die();
}
