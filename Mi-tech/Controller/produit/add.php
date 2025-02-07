<?php
require_once "../config/Database.php";
require_once "../Model/produit.php";

if (isset($_POST["addProduct"])) {
    $libelle = htmlspecialchars(trim($_POST["libelle"]));
    $prix = htmlspecialchars(trim($_POST["prix"]));
    $categorie = $_POST["categorie"];
    $quantite = $_POST["quantite"];

    $id_produit = addProduct($db, $libelle, $prix, $categorie, $quantite);
    if ($id_produit) {
        $uploadDir = 'image/uploads/';
        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            $originalFileName = $_FILES['photos']['name'][$key];
            $fileTmpPath = $_FILES['photos']['tmp_name'][$key];
            $fileError = $_FILES['photos']['error'][$key];
        
            if ($fileError === 0) {
                $cleanFileName = preg_replace('/[^A-Za-z0-9\-.]/', '_', $originalFileName);
                $uniqueFileName = uniqid() . '_' . $cleanFileName;
                $destinationPath = $uploadDir . $uniqueFileName;
        
                if (addPhoto($db, $uniqueFileName, $id_produit)) {
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                        $_SESSION["success"] = "Produit enregistré";
                        $_SESSION["title"] = "Enregistrement d'un produit";
                        $_SESSION["newUrl"] = "/produits";
                        echo("<script>window.location.href='/produits'</script>");
                    }else {
                        $_SESSION["error"] = "Impossible d'enregistrer les photos";
                        $_SESSION["title"] = "Enregistrement d'un produit";
                        $_SESSION["newUrl"] = "/produits";
                        echo("<script>window.location.href='/produits'</script>");
                    }
                } else {
                    $_SESSION["error"] = "Erreur lors du téléchargement de la photo ".$originalFileName;
                    $_SESSION["title"] = "Enregistrement d'un produit";
                    $_SESSION["newUrl"] = "/produits";
                    echo("<script>window.location.href='/produits'</script>");
                }
            } else {
                $_SESSION["error"] = "Erreur avec le fichier ".$originalFileName;
                $_SESSION["title"] = "Enregistrement d'un produit";
                $_SESSION["newUrl"] = "/produits";
                echo("<script>window.location.href='/produits'</script>");
            }
        }
    }else {
        $_SESSION["error"] = "Impossible d'enregistrer le produit";
        $_SESSION["title"] = "Enregistrement d'un produit";
        $_SESSION["newUrl"] = "/produits";
        echo("<script>window.location.href='/produits'</script>");
    }
}



