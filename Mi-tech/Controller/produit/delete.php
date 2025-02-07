<?php
require_once "../config/Database.php";
require_once "../Model/produit.php";

if (isset($_POST["deleteProduct"])) {
    $id = $_POST["idProduit"];

    if (deleteProduct($db, $id)) {
        if (deleteProductImage($db, $id)) {
            $_SESSION["success"] = "Produit supprimé";
            $_SESSION["title"] = "Suppression d'un produit";
            $_SESSION["newUrl"] = "/produits";
            echo("<script>window.location.href='/produits'</script>");
        }else {
            $_SESSION["error"] = "Erreur de suppression des images";
            $_SESSION["title"] = "Suppression d'un produit";
            $_SESSION["newUrl"] = "/produits";
            echo("<script>window.location.href='/produits'</script>");
        }
    }else {
        $_SESSION["error"] = "Erreur de suppression du produit";
        $_SESSION["title"] = "Suppression d'un produit";
        $_SESSION["newUrl"] = "/produits";
        echo("<script>window.location.href='/produits'</script>");
    }
}