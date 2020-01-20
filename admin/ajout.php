<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");


/* $marque = listerMarques($conn);
 */$categorie = listerCategories($conn);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Catalogue des produits</h1>
    <!--     <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
    -->    <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a>
            <a href="index.php">Catalogue Admin</a>
            <a href="listeCommandes.php">Commandes</a>
        </p>
    </header>

    <main>
        <h1>Ajout d'un produit</h1>

        <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

        <form action="" method="post">

            <label>Numero categorie</label>
            <input type="text" name="id" value="<?php echo isset($categorieId) ? $categorieId : "" ?>" required>
            <span><?php echo isset($erreurs['categorieId']) ? $erreurs['categorieId'] : "&nbsp;"  ?></span>

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


            <label>Description du produit </label>
            <input type="text" name="description" value="<?php echo isset($description) ? $description : "" ?>" required>
            <span><?php echo isset($erreurs['description']) ? $erreurs['description'] : "&nbsp;"  ?></span>

            <label>Numero de serie</label>
            <input type="text" name="id" value="<?php echo isset($id) ? $id : "" ?>" required>
            <span><?php echo isset($erreurs['id']) ? $erreurs['id'] : "&nbsp;"  ?></span>

            <label>Nom du produit</label>
            <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
            <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>

            <label>Prix du produit</label>
            <input type="text" name="prix" value="<?php echo isset($prix) ? $prix : "" ?>" required>
            <span><?php echo isset($erreurs['prix']) ? $erreurs['prix'] : "&nbsp;"  ?></span>

            <label>Quantité du produit</label>
            <input type="text" name="quantite" value="<?php echo isset($quantite) ? $quantite : "" ?>" required>
            <span><?php echo isset($erreurs['quantite']) ? $erreurs['quantite'] : "&nbsp;"  ?></span>



            




        <input type="submit" name="envoi" value="Envoyez">

        <?php if (isset($_POST["envoi"]))
            ajouterProduit($conn, $_POST);
        ?>

        </form>

    </main>
</body>

</html>