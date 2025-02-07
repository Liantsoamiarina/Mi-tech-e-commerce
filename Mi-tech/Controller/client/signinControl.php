<?php
require_once "../config/Database.php";
require_once "../Config/managePassword.php";
require_once "../Model/client.php";

if (isset($_POST["signIn"])) {
    if (managePassword($_POST["password"])) {
        $mdp = password_hash($_POST["password"], PASSWORD_BCRYPT);
        $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
        
        if (signIn($db, $email, $mdp)) {
            $_SESSION["success"] = "Inscription avec succès";
            $_SESSION["title"] = "Inscription";
            $_SESSION["newUrl"] = "/login";
            echo("<script>window.location.href='/login'</script>");
        }else {
            $_SESSION["error"] = "Il y avait une erreur lors de l'inscription!";
            $_SESSION["title"] = "Inscription";
            $_SESSION["newUrl"] = "/signin";
            echo("<script>window.location.href='/signin'</script>");
        }
    }else {
        $_SESSION["error"] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
        $_SESSION["title"] = "Inscription";
        $_SESSION["newUrl"] = "/signin";
        echo("<script>window.location.href='/signin'</script>");
    }
}