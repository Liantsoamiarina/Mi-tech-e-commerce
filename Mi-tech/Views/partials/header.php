<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/font/roboto/roboto.css">
    <link rel="stylesheet" href="assets/font/inter/inter.css">
    <?php if (!empty($_SESSION["label"])) : ?>
        <link rel="stylesheet" href="assets/css/<?=$_SESSION["label"]?>.css">
    <?php endif;?>
    <?php if (!empty($_SESSION["style"])) : ?>
        <link rel="stylesheet" href="assets/css/<?=$_SESSION["style"]?>.css">
    <?php endif;?>
    <?php if (!empty($_SESSION["titlePage"])) : ?>
        <title><?=$_SESSION["titlePage"]?></title>
    <?php endif;?>
</head>
<body>
