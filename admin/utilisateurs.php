<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");


$liste = listerUtilisateurs($conn);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue des utilisateurs</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Catalogue des utilisateurs</h1>
<!--     <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
 -->    <p class="menu">
        <a href="../deconnexion.php">Déconnexion</a>
        <a href="index.php">Catalogue Admin</a>
        <a href="ajoutCategorie.php">Ajouter une categorie</a>
        <a href="listeCommandes.php">Commandes</a>
        <a href="ajoutClients.php">Ajouter un client</a>
        <a href="ajoutUtilisateurs.php">Ajouter un utilisateur</a>


    </p>

    <table>
        <tr>
            <th>Identifiant</th>
            <th>Mot de passe</th>
            <th>Niveau d'accès</th>


            <th>Action</th>
        </tr>

        <?php foreach ($liste as $row) :
            ?>
            <tr>
                <td><?= $row["utilisateurs_nom"] ?></td>
                <td><?= $row["utilisateurs_password"] ?></td>
                <td><?= $row["utilisateurs_privilege"] ?></td>


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