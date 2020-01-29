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

<header>
    <h1>Luna Inc.</h1> 
    <h3>Catalogue des produits</h3>
</header>





<body>
    <main class="boiteGrise">              
        <table class="affichage">
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
                    <td><?= $row["fk_categorie_id"] ?></td>
                    <!-- <td> 
                        <a href="modificationProduit.php?id=<?= $row['produit_id'] ?>">Modifier</a>
                        <a href="suppressionProduit.php?id=<?= $row['produit_id'] ?>">Supprimer</a>
                    </td> -->
                    
                </tr>
            <?php
            endforeach; ?>
        </table>
      

<!--     NAVIGATION     -->    
        <?php include "../navigation.php"; ?>
    </main>
    <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>


    

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
