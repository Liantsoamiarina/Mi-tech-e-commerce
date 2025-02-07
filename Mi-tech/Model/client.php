<?php
//Inscription
function signIn($db, $email, $mdp) {
    $sql = "INSERT INTO client (email_client, mdp_client) VALUES(:email, :mdp)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":mdp", $mdp);

    if ($stmt->execute()) {
        return true;
    }else {
        return false;
    }
}

//Authentification
function logIn($db, $email) {
    $sql = "SELECT * FROM client WHERE email_client=:email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":email", $email);

    if ($stmt->execute()) {
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        return [
            "donnees"=> $resultat,
            "count"=> $count,
        ];
    }else {
        return false;
    }
}

//Affichage les clients
function showClient($db){
    $sql = "SELECT id_client, email_client FROM client ORDER BY id_client DESC";
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

//Suppression d'un client
function deleteClient($db, $id){
    $sql = "DELETE FROM client WHERE id_client=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id);
    
    if ($stmt->execute()) {
        return true;
    }else {
        return false;
    }
}