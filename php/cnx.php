<?php
$parametres = parse_ini_file("param/param.ini");

/* INFOS CO BDD

[bdd]
dsn = "mysql:host=localhost;dbname=waveon;charset=utf8"
user = "root"
psw = ""
host = "http://localhost/www/Projet_S2_Waveon/php/"


*/


// connexion à la bdd avec fichier de paramètres
$bdd = new PDO(
    $parametres['dsn'],
    $parametres['user'],
    $parametres['psw'],
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
// Adresse serveur de l'application
$host = $parametres['host'];