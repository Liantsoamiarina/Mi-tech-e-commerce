<?php
require_once "../config/Database.php";
require_once "../Model/panier.php";

if (isset($_POST["ajouterAuPanier"])) {
    $id = $_POST["idProduit"];
    $libelle = $_POST["libelle"];
    $quantite = $_POST["quantite"];
    $prixTotal = $_POST["prixTotal"];

    if (ajouterAuPanier($id, $libelle, $quantite, $prixTotal)) {
        header("location:/cartinfo?id=".$id);
    }else {
        $_SESSION["error"] = "Article non ajouté!";
        $_SESSION["title"] = "Ajout au panier";
        $_SESSION["newUrl"] = "/cartinfo?id=".$id;
        echo("<script>window.location.href='/cartinfo?id=".$id."'</script>");
    }
}

