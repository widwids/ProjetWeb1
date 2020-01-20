<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");
require_once("../inc/sessionAdmin.php");



$moi = isset($_GET['envoi']) ? trim($_GET['Mois']) : "";


$clients = dixMeilleursClients($conn, $moi)
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        input {
            margin-bottom: 150px
        }
    </style>
</head>

<body>

    <header>
        <h1>Dashboard Admin - Statistiques de ventes</h1>
        <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
        <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a>
            <a href="index.php">Catalogue Admin</a>
            <a href="ajout.php">Ajouter</a>
            <a href="statistiquesVentes.php">Statistiques de ventes</a>
        </p>

        <!-- Selection du mois -->
        <form method="GET">
            <select name="Mois">
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <table>
                <tr>
                    <th>Client id</th>
                    <th>Nom - Prenom</th>
                    <th>Date d'achat</th>
                    <th>Commande Client id</th>

                </tr>
                <?php foreach ($clients as $commande) :
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $commande["client_id"] ?></td>
                        <td ><?= $commande["nom prenom"] ?></td>
                        <td style="text-align: center;"><?= $commande["commande_date"] ?></td>
                        <td style="text-align: center;"><?= $commande["commande client id"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <input type="hidden" name="commandeDate" value="<?php $m ?>">
            <input type="submit" name="envoi">

        </form>

</body>

</html>