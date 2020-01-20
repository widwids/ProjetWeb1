<?php
require_once("inc/connectDB.php");
require_once("inc/sql.php");
require_once("inc/sessionUtilisateur.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Produits commandés</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <h1>Panier</h1>
    <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
</body>

</html>