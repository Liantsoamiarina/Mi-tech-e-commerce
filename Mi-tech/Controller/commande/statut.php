<?php
require_once "../config/Database.php";
require_once "../Model/commande.php";

if (isset($_POST["expedier"])) {
    $statut = "Expédié";
    $id = $_POST["id"];
    if (statut($db, $statut, $id)) {
        echo("<script>window.location.href='/commande'</script>");
    }else {
        $_SESSION["error"] = "Impossible de mettre à jour le statut";
        $_SESSION["title"] = "Mise à jour d'un statut d'une commande";
        $_SESSION["newUrl"] = "/commande";
        echo("<script>window.location.href='/commande'</script>");
    }
}else if (isset($_POST["livrer"])) {
    $statut = "Livré";
    $id = $_POST["id"];
    if (statut($db, $statut, $id)) {
        echo("<script>window.location.href='/commande'</script>");
    }else {
        $_SESSION["error"] = "Impossible de mettre à jour le statut";
        $_SESSION["title"] = "Mise à jour d'un statut d'une commande";
        $_SESSION["newUrl"] = "/commande";
        echo("<script>window.location.href='/commande'</script>");
    }
}