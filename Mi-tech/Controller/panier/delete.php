<?php
require_once "../config/Database.php";
require_once "../Model/panier.php";

if (isset($_GET["idDel"])) {
    $id = $_GET["idDel"];
    if (supprimerDuPanier($id)) {
        header("location:/cartinfo");
    }else {
        $_SESSION["error"] = "Erreur de suppression de l'article";
        $_SESSION["title"] = "Suppression d'un article";
        $_SESSION["newUrl"] = "/cartinfo?id=".$id;
        echo("<script>window.location.href='/cartinfo?id=".$id."'</script>");
    }
}