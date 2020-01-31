<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");
require_once("../inc/sessionAdmin.php");
$pourcentage = 10;
$nbLimitProduits = ProduitsParPoucentage($conn, $pourcentage);
$liste = ProduitsPopulaire($conn, $nbLimitProduits);
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Liste des meilleurs produits">
    <title>statistiques de ventes</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title><?php echo $pourcentage ?>% des meilleurs Produits</title>



</head>

<body>
    <main>
        <h1>Dashboard Admin - Statistiques de ventes</h1>
        <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
        <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a>
            <a href="ajout.php">Ajouter</a>
            <a href="listeCommandes.php">Commandes</a>
            <a href="meilleurClient.php">Top 10 des meilleurs clients</a>
        </p>
        <h1><?php echo $pourcentage ?>% meilleurs Produits</h1>
        <table>
            <tr>
                <th>Catégorie</th>
                <th>Marque</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Qty en stock</th>
            </tr>
            <?php foreach ($liste as $produit) :
            ?>
                <tr>
                    <td><?php echo $produit['categorie_nom'] ?></td>
                    <td><?php echo $produit['marque_nom'] ?></td>
                    <td><?php echo $produit['produit_nom'] ?></td>
                    <td><?php echo $produit['produit_description'] ?></td>
                    <td><?php echo $produit['produit_prix'] ?>$</td>
                    <td><?php echo $produit['produit_quantite'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>



</body>

</html>