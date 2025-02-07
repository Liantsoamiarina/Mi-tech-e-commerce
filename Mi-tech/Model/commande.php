<?php

//Ajout d'une commande
function passCommande($db, $nom, $prenom, $email, $contact, $adresse, $message, $statut, $qte, $prix, $id_client, $id_produit) {
    $sql = "INSERT INTO commande (nom, prenom, email, contact, adresse, message, statut, qte, prix, id_client, id_produit) VALUES (:nom, :prenom, :email, :contact, :adresse, :message, :statut, :qte, :prix, :id_client, :id_produit)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":contact", $contact);
    $stmt->bindParam(":adresse", $adresse);
    $stmt->bindParam(":message", $message);
    $stmt->bindParam(":statut", $statut);
    $stmt->bindParam(":qte", $qte);
    $stmt->bindParam(":prix", $prix);
    $stmt->bindParam(":id_client", $id_client);
    $stmt->bindParam(":id_produit", $id_produit);

    if ($stmt->execute()) {
        return true;
    }else {
        return false;
    }
}

//Affichage des commandes
function showCommande($db){
    $sql = "SELECT commande.prix AS commande_prix, produit.prix AS produit_prix,commande.*, produit.* FROM commande LEFT JOIN produit ON commande.id_produit=produit.id_produit ORDER BY commande.date DESC";

    $stmt = $db->prepare($sql);
    
    if ($stmt->execute()) {
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        return [
            'donnees' => $resultat,
            'count' => $count
        ];
    }else {
        return false;
    }
}

//Gestion des statuts
function statut($db, $statut, $id) {
    $sql = "UPDATE commande SET statut=:statut WHERE id_commande=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":statut", $statut);
    $stmt->bindParam(":id", $id);
    if ($stmt->execute()) {
        return true;
    }else {
        return false;
    }
}