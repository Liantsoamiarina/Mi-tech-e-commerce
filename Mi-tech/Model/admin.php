<?php
//Authentification
function logIn($db, $email) {
    $sql = "SELECT * FROM admin WHERE email=:email";
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