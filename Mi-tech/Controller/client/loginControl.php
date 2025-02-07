<?php
require_once "../config/Database.php";
require_once "../Model/client.php";

if (isset($_POST["logIn"])) {
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $clientAccount = logIn($db, $email);
    if ($clientAccount["count"] > 0) {
        foreach ($clientAccount["donnees"] as $user) {
            if (password_verify($_POST["pass"], $user["mdp_client"])) {
                $_SESSION["client"] = [
                    "id"=>$user["id_client"],
                    "email"=>$user["email_client"],
                    "panier"=>[],
                ];
                echo("<script>window.location.href='/'</script>");
            }else {
                $_SESSION["error"] = "Le mot de passe est incorrect!";
                $_SESSION["title"] = "Connexion";
                $_SESSION["newUrl"] = "/login";
                echo("<script>window.location.href='/login'</script>");
            }
        }
    }else {
        $_SESSION["error"] = "Compte introuvable!";
        $_SESSION["title"] = "Connexion";
        $_SESSION["newUrl"] = "/login";
        echo("<script>window.location.href='/login'</script>");
    }
}