<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");


$liste = listerUtilisateurs($conn);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

</head>

<header>
    <h1>Luna Inc.</h1> 
    <h3>Liste des utilisateurs</h3>
</header>






<body>
    <main class="boiteGrise">
        <table class="affichage">
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