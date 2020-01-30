<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

// Catalogue client
$recherche = isset($_POST['recherche']) ? trim($_POST['recherche']) : "";

$liste = listerProduits($conn, $recherche);
$categorie = listerCategories($conn);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue produits</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

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
                    <form action="" method="post">
                    <td><input type="text" name="produits_id" value="<?= $row["produits_id"] ?>" readonly></td>

                    <td><input type="text" name="produits_nom" value="<?= $row["produits_nom"] ?>" required></td>
                    <td><input type="text" name="produits_description" value="<?= $row["produits_description"] ?>" required></td>
                    <td><input type="text" name="produits_prix" value="<?= $row["produits_prix"] ?>" required></td>
                    <td><input type="text" name="produits_quantite" value="<?= $row["produits_quantite"] ?>" required></td>
                    <td>
                        <select name="fk_categorie_id">
                                <?php foreach ($categorie as $rowCategorie) : ?>
                                    <option <?php if($rowCategorie["categories_id"] == $row["fk_categorie_id"]) { echo 'selected="selected"'; }?> value="<?= $rowCategorie["categories_id"] ?>"><?= $rowCategorie["categories_nom"] ?></option>
                                <?php endforeach; ?>
                        </select>
                    </td>

                    <td><input type="submit" name="envoiModifier" value="Modifier"></td>

                    
                    </form>
                    
                </tr>
            <?php
            endforeach; ?>
        </table>
      
        <?php if (isset($_POST["envoiModifier"]))
        modifierProduit($conn, $_POST);?>
        
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
