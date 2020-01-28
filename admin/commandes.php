<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

$liste = listerCommandes($conn);


?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Commande</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<header>
    <h1>Luna Inc.</h1> 
    <h3>Catalogue des commandes</h3>
</header>

<body>
    <section>
        <table>
            <tr>
                <th>Numéro de commande</th>
                <th>Date</th>
                <th>Adresse</th>
                <th>État</th>
                <th>Commentaire</th>
                <th>Nom du client</th>
                <th>Produit</th>
                <th>Quantite</th>


                <th>Action</th>
            </tr>
            <?php foreach ($liste as $row) :
                ?>
                <tr>
                    <td><?= $row["Numéro de commande"] ?></td>
                    <td><?= $row["Date"] ?></td>
                    <td><?= $row["Adresse"] ?></td>
                    <td><?= $row["État"] ?></td>
                    <td><?= $row["Commentaire"] . "" ?></td>
                    <td><?= $row["Nom du client"] ?></td>
                    
                    <td><?= $row["Produit"] ?></td>
                    <td><?= $row["Quantite"] ?></td>

                    <!-- <td> 
                        <a href="modificationProduit.php?id=<?= $row['produit_id'] ?>">Modifier</a>
                        <a href="suppressionProduit.php?id=<?= $row['produit_id'] ?>">Supprimer</a>
                    </td> -->
                    
                </tr>
            <?php
            endforeach; ?>
        </table>




        <nav>
    <!--     <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
    -->    <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a><br>
            <a href="ajoutCommande.php">Ajouter une commande</a><br>
            <a href="commandes.php">Commandes</a><br>
            <a href="categorie.php">Categories</a><br>
            <a href="clients.php">Catalogue de clients</a><br>
            <a href="utilisateurs.php">Catalogue des utilisateurs</a>
        </p>
    <!--     <form id="recherche" action="" method="post">
            <label>Produit</label>
            <input type="text" name="recherche" value="<?= $recherche ?>" placeholder="nom du produit contient ces caractères">
            <input type="submit" value="Recherchez">
        </form> -->
        </nav>

    </section>
    

    

    <?php if (isset($_POST["envoi"])) : ?>


        <!-- <section>
            <p>Confirmez la commande de <?= $_POST['nbCommande'] ?> exemplaire(s) de <?= $_POST['nomProduit'] ?></p>
            <form class="form-suppression" action="" method="post">
                <input type="hidden" name="genre_id" value="<?= $id ?>">
                <input type="submit" name="confirme" value="OUI">
                <input type="submit" name="confirme" value="NON">
            </form>
        </section> -->

        
    <?php endif; ?>

</body>

</html>
