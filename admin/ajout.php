<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");


$categorie = listerCategories($conn);

?>


<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Ajout d'un produit</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>

    <header>
        <h1>Luna Inc.</h1> 
        <h3>Ajouter un produit</h3>
    </header>




    <body>
        <main class="boiteGrise">
            <section class="affichage">
                         
                  
                    <form action="" method="post">

                    <label>Nom du produit</label>
                    <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
                    <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span><br>

                    <label>Description du produit </label>
                    <input type="text" name="description" value="<?php echo isset($description) ? $description : "" ?>" required>
                    <span><?php echo isset($erreurs['description']) ? $erreurs['description'] : "&nbsp;"  ?></span><br>

                    <label>Prix du produit</label>
                    <input type="text" name="prix" value="<?php echo isset($prix) ? $prix : "" ?>" required>
                    <span><?php echo isset($erreurs['prix']) ? $erreurs['prix'] : "&nbsp;"  ?></span><br>

                    <label>Quantité du produit</label>
                    <input type="text" name="quantite" value="<?php echo isset($quantite) ? $quantite : "" ?>" required>
                    <span><?php echo isset($erreurs['quantite']) ? $erreurs['quantite'] : "&nbsp;"  ?></span><br>

                    <table>
                        <?php if (count($categorie) > 0) : ?>

                            <label>Categorie du produit</label>
                            <select name="categorie">
                                <?php foreach ($categorie as $row) : ?>
                                    <option value="<?= $row["categories_id"] ?>"><?= $row["categories_nom"] ?></option>
                                <?php endforeach; ?>
                            </select>
                    </table>
                        <?php else : ?>
                            <p>Aucune categorie trouvé.</p>
                        <?php endif; ?>


                    <input type="submit" name="envoi" value="Envoyer">

                    <?php if (isset($_POST["envoi"]))
                    ajouterProduit($conn, $_POST);
                    ?>

                    </form>
                
            </section>     

<!--     NAVIGATION     -->    
        <?php include "../navigation.php"; ?>
        </main>
    </body>


<!--     <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>
 -->
</html>