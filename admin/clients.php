<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");


$liste = listerClients($conn);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue des clients</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Catalogue des clients</h1>
<!--     <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
 -->    <p class="menu">
        <a href="../deconnexion.php">Déconnexion</a>
        <a href="index.php">Catalogue Admin</a>
        <a href="ajoutCategorie.php">Ajouter une categorie</a>
        <a href="listeCommandes.php">Commandes</a>
        <a href="ajoutClients.php">Ajouter un client</a>
        <a href="utilisateurs.php">Catalogue des utilisateurs</a>


    </p>

    <table>
        <tr>
            <th>Numero de client</th>
            <th>Adresse</th>
            <th>Telephone</th>
            <th>Nom</th>


            <th>Action</th>
        </tr>

        <?php foreach ($liste as $row) :
            ?>
            <tr>
                <td><?= $row["clients_id"] ?></td>
                <td><?= $row["clients_adresse"] ?></td>
                <td><?= $row["clients_telephone"] ?></td>
                <td><?= $row["clients_nom"] ?></td>


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