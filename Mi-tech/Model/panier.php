<?php

//Ajouter un article au panier
function ajouterAuPanier($idProduit, $libelle, $quantite, $prix) {
    if (!isset($_SESSION["client"]["panier"])) {
        $_SESSION["client"]["panier"] = [];
    }
    if (isset($_SESSION["client"]["panier"][$idProduit])) {
        $_SESSION["client"]["panier"][$idProduit]["quantite"] = 0;
        $_SESSION["client"]["panier"][$idProduit]["prix"] = 0;
        $_SESSION["client"]["panier"][$idProduit]["quantite"] = $quantite;
        $_SESSION["client"]["panier"][$idProduit]["prix"] = $prix;
    } 
    else {
        $_SESSION["client"]["panier"][$idProduit] = [
            "id" => $idProduit,
            "libelle" => $libelle,
            "quantite" => $quantite,
            "prix" => $prix,
        ];
    }
    return true;
}

//Suppression d'un article dans le panier
function supprimerDuPanier($idProduit) {
    if (isset($_SESSION["client"]["panier"][$idProduit])) {
        unset($_SESSION["client"]["panier"][$idProduit]);
        return true;
    } else {
        return false;
    }
}
