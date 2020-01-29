<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");


$liste = listerCategories($conn);


?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Catalogue des categories</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>

    <header>
        <h1>Luna Inc.</h1> 
        <h3>Catalogue des categories</h3>
    </header>


        
    <body>
        <main class="boiteGrise">
            <table class="affichage">
                <tr>
                    <th>Numero de serie</th>
                    <th>Nom</th>

                    <th>Action</th>
                </tr>

                <?php foreach ($liste as $row) :
                    ?>
                    <tr>
                        <td><?= $row["categories_id"] ?></td>
                        <td><?= $row["categories_nom"] ?></td>

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