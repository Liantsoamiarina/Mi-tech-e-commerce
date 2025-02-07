<?php
/*
        ADMIN : Liantsoa@gmail.com
                Liantsoa05$

*/
// on va se connecter avec la bdd
$username = "root";
$pass = "";
// on definit une variable de connexion
try {
    $db = new PDO("mysql:host=localhost;dbname=ecom",$username,$pass);
} catch (PDOException $e) {
    die("erreur de connexion".$e->getMessage());
}
