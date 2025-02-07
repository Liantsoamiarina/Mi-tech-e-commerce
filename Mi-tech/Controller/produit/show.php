<?php
require_once "../config/Database.php";
require_once "../Model/produit.php";

$product_list = showProduct($db);
$produits = [];

foreach ($product_list["donnees"] as $row) {
    $id_produit = $row->id_produit;

    if (!isset($produits[$id_produit])) {
        $produits[$id_produit] = [
            'id_produit' => $row->id_produit,
            'libelle_produit' => $row->libelle,
            'prix' => $row->prix,
            'categorie' => $row->categorie,
            'quantite' => $row->quantite,
            'photos' => []
        ];
    }

    if (!empty($row->file_name) && !in_array('uploads/' . $row->file_name, $produits[$id_produit]['photos'])) {
        $produits[$id_produit]['photos'][] = 'uploads/' . $row->file_name;
    }
}
