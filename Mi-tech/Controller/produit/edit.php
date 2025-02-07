<?php
require_once "../config/Database.php";
require_once "../Model/produit.php";

if (isset($_POST["editProduct"])) {
    $libelle = htmlspecialchars(trim($_POST["libelle"]));
    $prix = htmlspecialchars(trim($_POST["prix"]));
    $categorie = $_POST["categorie"];
    $quantite = $_POST["quantite"];
    $id = $_POST["idProduit"];

    if (editProduct($db, $libelle, $prix, $categorie, $quantite, $id)) {
        $_SESSION["success"] = "Produit mis à jour";
        $_SESSION["title"] = "Mise à jour d'un produit";
        $_SESSION["newUrl"] = "/produits";
        echo("<script>window.location.href='/produits'</script>");
    }else {
        $_SESSION["error"] = "Impossible de mettre à jour le produit";
        $_SESSION["title"] = "Mise à jour d'un produit";
        $_SESSION["newUrl"] = "/produits";
        echo("<script>window.location.href='/produits'</script>");
    }
}



