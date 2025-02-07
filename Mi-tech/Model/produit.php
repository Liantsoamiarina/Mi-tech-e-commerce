<?php
    function addProduct($db, $libelle, $prix, $categorie, $quantite) {
        $sql = "INSERT INTO produit (libelle, prix, categorie, quantite) VALUES (:libelle, :prix, :categorie, :quantite)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":libelle", $libelle);
        $stmt->bindParam(":prix", $prix);
        $stmt->bindParam(":categorie", $categorie);
        $stmt->bindParam(":quantite", $quantite);

        if ($stmt->execute()) {
            $produitId = $db->lastInsertId();
            return $produitId;
        }else {
            return false;
        }
    }

    function addPhoto($db, $uniqueFileName, $id_produit){
        $sql = "INSERT INTO photos (file_name, id_produit) VALUES (:file_name, :produit_id)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':file_name', $uniqueFileName);
        $stmt->bindParam(':produit_id', $id_produit);
        if ($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }

    function showProduct($db) {
        try {
            $sql = "SELECT produit.id_produit, produit.libelle, produit.prix, produit.categorie, produit.quantite, photos.file_name FROM produit LEFT JOIN photos ON produit.id_produit = photos.id_produit ORDER BY produit.id_produit DESC";
            
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $resultat = $stmt->fetchAll(PDO::FETCH_OBJ);
            return ['donnees' => $resultat]; 

        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des produits : " . $e->getMessage();
            return false;
        }
    }

    function showOneProduct($db, $id) {
        try {
            $sql = "SELECT produit.id_produit, produit.libelle, produit.prix, produit.categorie, produit.quantite, photos.file_name FROM produit LEFT JOIN photos ON produit.id_produit = photos.id_produit WHERE produit.id_produit =:id ORDER BY produit.id_produit DESC";
            
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $resultat = $stmt->fetchAll(PDO::FETCH_OBJ);
            $count = $stmt->rowCount();
            return [
                'donnees' => $resultat,
                'count' => $count,
            ]; 

        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des produits : " . $e->getMessage();
            return false;
        }
    }

    function deleteProduct($db, $id) {
        $sql = "DELETE FROM produit WHERE id_produit=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }

    function deleteProductImage($db, $id) {
        $sql = "DELETE FROM photos WHERE id_produit=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }

    function editProduct($db, $libelle, $prix, $categorie, $quantite, $id){
        $sql = "UPDATE produit SET libelle=:libelle, prix=:prix, categorie=:categorie, quantite=:quantite WHERE id_produit=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":libelle", $libelle);
        $stmt->bindParam(":prix", $prix);
        $stmt->bindParam(":categorie", $categorie);
        $stmt->bindParam(":quantite", $quantite);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        }else {
            return false;
        }
    }

    function manageStock($db, $id, $qte) {
        $sql = "UPDATE produit SET quantite = quantite - :qte WHERE id_produit = :id AND quantite >= :qte";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":qte", $qte, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    

