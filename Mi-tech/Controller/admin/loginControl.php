<?php
require_once "../config/Database.php";
require_once "../Config/feedbackInitial.php";
require_once "../Model/admin.php";

if (isset($_POST["logIn"])) {
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $adminAccount = logIn($db, $email);
    if ($adminAccount["count"] > 0) {
        foreach ($adminAccount["donnees"] as $admin) {
            if (password_verify($_POST["pass"], $admin["mdp"])) {
                $_SESSION["admin"] = [
                    "id"=>$admin["id"],
                    "email"=>$admin["email"],
                    "username"=>$admin["username"],
                ];
                echo("<script>window.location.href='/produits'</script>");
            }else {
                $_SESSION["error"] = "Le mot de passe est incorrect!";
                $_SESSION["title"] = "Connexion";
                $_SESSION["newUrl"] = "/admin";
                echo("<script>window.location.href='/admin'</script>");
            }
        }
    }else {
        $_SESSION["error"] = "Compte introuvable!";
        $_SESSION["title"] = "Connexion";
        $_SESSION["newUrl"] = "/admin";
        echo("<script>window.location.href='/admin'</script>");
    }
}