<?php
require_once "../config/Database.php";
require_once "../Model/client.php";

if (isset($_POST["deleteUser"])) {
    $id = $_POST["idUser"];
    if (deleteClient($db, $id)) {
        $_SESSION["success"] = "Client supprimé avec succès";
        $_SESSION["title"] = "Suppression d'un client";
        $_SESSION["newUrl"] = "/clients";
        echo("<script>window.location.href='/clients'</script>");
    }else {
        $_SESSION["error"] = "Erreur de suppression";
        $_SESSION["title"] = "Suppression d'un client";
        $_SESSION["newUrl"] = "/clients";
        echo("<script>window.location.href='/clients'</script>");
    }
}