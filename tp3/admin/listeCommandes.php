<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");
require_once("../inc/sessionAdmin.php");

// Catalogue client
$recherche = isset($_POST['recherche']) ? trim($_POST['recherche']) : "";

$liste = listerCommandes($conn, $recherche);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Listes de commandes</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Liste des commandes</h1>
    <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
    <p class="menu">
        <a href="../deconnexion.php">Déconnexion</a>
        <a href="index.php">Catalogue Admin</a>
        <a href="ajout.php">Ajouter</a>
        <a href="statistiquesVentes.php">Statistiques de ventes</a>
        <a href="meilleurClient.php">Top 10 des meilleurs clients</a>
    </p>

    <form id="recherche" action="" method="post">
        <label>Client</label>
        <input type="text" name="recherche" value="<?= $recherche ?>" placeholder="nom ou prénom du client">
        <input type="submit" value="Recherchez">
    </form>

    <table>
        <tr>
            <th>Numéro de commande</th>
            <th>Nom du client</th>
            <th>Produits commandés</th>
            <th>Quantités commandées</th>
        </tr>
        <?php foreach ($liste as $row) :
        ?>
            <tr>
                <td style="text-align: center;"><?= $row["commande_id"] ?></td>
                <td><?= $row["commande_client"] ?></td>
                <td><?= implode("<br>", $row["commande_produit"]) ?></td>
                <td style="text-align: center;"><?= implode("<br>", $row["commande_quantite"]) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>