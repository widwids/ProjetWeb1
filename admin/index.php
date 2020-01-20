<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

// Catalogue client
$recherche = isset($_POST['recherche']) ? trim($_POST['recherche']) : "";

$liste = listerProduits($conn, $recherche);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue produits</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Catalogue des produits</h1>
<!--     <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
 -->    <p class="menu">
        <a href="../deconnexion.php">Déconnexion</a>
        <a href="ajout.php">Ajouter</a>
        <a href="listeCommandes.php">Commandes</a>
    </p>
<!--     <form id="recherche" action="" method="post">
        <label>Produit</label>
        <input type="text" name="recherche" value="<?= $recherche ?>" placeholder="nom du produit contient ces caractères">
        <input type="submit" value="Recherchez">
    </form> -->

    <table>
        <tr>
            <th>Numero de serie</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Catégorie</th>

            <th>Action</th>
        </tr>
        <?php foreach ($liste as $row) :
            ?>
            <tr>
                <td><?= $row["produits_id"] ?></td>
                <td><?= $row["produits_nom"] ?></td>
                <td><?= $row["produits_description"] ?></td>
                <td><?= $row["produits_prix"] . " $" ?></td>
                <td><?= $row["produits_quantite"] . "" ?></td>
                <td><?= $row["categorie_id"] ?></td>
                <!-- <td> 
                    <a href="modificationProduit.php?id=<?= $row['produit_id'] ?>">Modifier</a>
                    <a href="suppressionProduit.php?id=<?= $row['produit_id'] ?>">Supprimer</a>
                </td> -->
                   
            </tr>
        <?php
        endforeach; ?>
    </table>
    <?php if (isset($_POST["envoi"])) : ?>
        <section>
            <p>Confirmez la commande de <?= $_POST['nbCommande'] ?> exemplaire(s) de <?= $_POST['nomProduit'] ?></p>
            <form class="form-suppression" action="" method="post">
                <input type="hidden" name="genre_id" value="<?= $id ?>">
                <input type="submit" name="confirme" value="OUI">
                <input type="submit" name="confirme" value="NON">
            </form>
        </section>
    <?php endif; ?>

</body>

</html>
