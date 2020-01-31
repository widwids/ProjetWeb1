<?php
require_once("../sessionGestion.php");
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
        <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

    </head>

    <header>
    <h1><a href="commandes.php">Luna Inc.</a></h1> 
        <h3>Catalogue des categories</h3>
    </header>


        
    <body>
        <main class="boiteGrise">

            <section class="affichage">
                <form action="" method="post">
                    <h3>Ajouter une categorie de produit : </h3>
                    <label>Nom de la categorie :</label>
                    <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
                    <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>
                
                <input class="submit" type="submit" name="envoi" value="Enregistrer">

                <?php if (isset($_POST["envoi"]))
                    ajouterCategorie($conn, $_POST);
                ?>
                </form>
            </section>
      

      <!--     NAVIGATION     -->    
              <?php include "../navigation.php"; ?>



            <table class="affichage">
                <tr>
                    <th>Numéro de catégorie</th>
                    <th>Nom</th>

                    <th>Action</th>
                </tr>

                <?php foreach ($liste as $row) :
                    ?>
                    <tr>
                    <form action="" method="post">
                        <td><input type="text" name="categories_id" value="<?= $row["categories_id"] ?>" readonly></td>
                        <td><input type="text" name="categories_nom" value="<?= $row["categories_nom"] ?>" required></td>

                        <td><input class="submit" type="submit" name="envoiModifier" value="Modifier"></td>
                        <td><input class="submit" type="submit" name="envoiSupprimer" value="Supprimer"></td>
                    </form>                             
                    </tr>
                <?php
                endforeach; ?>
            </table>     

      
        
        <?php if (isset($_POST["envoiModifier"]))
        modifierCategorie($conn, $_POST);?>

        <?php if (isset($_POST["envoiSupprimer"]))
        supprimerCategorie($conn, $_POST);?>


    </body>

</html>    