<?php
require_once "../config/Database.php";
require_once "../Model/produit.php";
require_once "../Model/commande.php";

if (isset($_POST["confirmCommande"])) {
    //Gestion des stocks
    $article = $_SESSION["client"]["panier"];
    foreach ($article as $stock) {
        $id = $stock["id"];
        $qte = $stock["quantite"];
        $prix = $stock["prix"];

        if (manageStock($db, $id, $qte)) {
            $nom = htmlspecialchars(trim($_POST["name"]));
            $prenom = htmlspecialchars(trim($_POST["firstname"]));
            $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
            $contact = htmlspecialchars(trim($_POST["phoneNumber"]));
            $adresse = htmlspecialchars(trim($_POST["adresse"]));
            $message = htmlspecialchars($_POST["comments"]);
            $statut = "En cours";
            $quantite = $qte;
            $id_client = $_SESSION["client"]["id"];
            $id_produit = $id;

            if (passCommande($db, $nom, $prenom, $email, $contact, $adresse, $message, $statut, $qte, $prix, $id_client, $id_produit)) {
                $_SESSION["client"]["panier"] = [];
                $_SESSION["success"] = "Commande passée!";
                $_SESSION["title"] = "Passation d'une commande";
                $_SESSION["newUrl"] = "/cartinfo";
                echo("<script>window.location.href='/cartinfo'</script>");
            }else {
                $_SESSION["error"] = "Commande non passée!";
                $_SESSION["title"] = "Passation d'une commande";
                $_SESSION["newUrl"] = "/cartinfo";
                echo("<script>window.location.href='/cartinfo'</script>");
            }
        }else {
            $_SESSION["error"] = "Commande non passée!";
            $_SESSION["title"] = "Passation d'une commande";
            $_SESSION["newUrl"] = "/cartinfo";
            echo("<script>window.location.href='/cartinfo'</script>");
        }
    }
}