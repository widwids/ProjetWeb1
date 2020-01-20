<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");
require_once("../inc/sessionAdmin.php");

$marque = listerMarques($conn);
$categorie = listerCategories($conn);

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
        <h1>Dashboard Admin - Ajouter un produit</h1>
        <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
        <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a>
            <a href="index.php">Catalogue Admin</a>
            <a href="listeCommandes.php">Commandes</a>
            <a href="statistiquesVentes.php">Statistiques de ventes</a>
            <a href="meilleurClient.php">Top 10 des meilleurs clients</a>
        </p>

    </header>
    <main>
        <h1>Ajout d'un produit</h1>

        <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

        <form action="" method="post">
            <label>Nom du produit</label>
            <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
            <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>

            <label>Description du produit </label>
            <input type="text" name="description" value="<?php echo isset($description) ? $description : "" ?>" required>
            <span><?php echo isset($erreurs['description']) ? $erreurs['description'] : "&nbsp;"  ?></span>

            <label>Prix du produit</label>
            <input type="text" name="prix" value="<?php echo isset($prix) ? $prix : "" ?>" required>
            <span><?php echo isset($erreurs['prix']) ? $erreurs['prix'] : "&nbsp;"  ?></span>

            <label>Quantité du produit</label>
            <input type="text" name="quantite" value="<?php echo isset($quantite) ? $quantite : "" ?>" required>
            <span><?php echo isset($erreurs['quantite']) ? $erreurs['quantite'] : "&nbsp;"  ?></span>



            <table>
                <?php if (count($categorie) > 0) : ?>

                    <label>Categorie du produit</label>
                    <select name="categorie">
                        <?php foreach ($categorie as $row) : ?>
                            <option value="<?= $row["categorie_id"] ?>"><?= $row["categorie_nom"] ?></option>
                        <?php endforeach; ?>
                    </select>
            </table>
        <?php else : ?>
            <p>Aucune categorie trouvé.</p>
        <?php endif; ?>


        <?php if (count($marque) > 0) : ?>
            <table>
                <label>Categorie du produit</label>
                <select name="marque">
                    <?php foreach ($marque as $row) : ?>
                        <option value="<?= $row["marque_id"] ?>"><?= $row["marque_nom"] ?></option>
                    <?php endforeach; ?>
                </select>
            </table>
        <?php else : ?>
            <p>Aucune categorie trouvé.</p>
        <?php endif; ?>


        <input type="submit" name="envoi" value="Envoyez">

        <?php if (isset($_POST["envoi"]))
            ajouterProduit($conn, $_POST);
        ?>

        </form>

    </main>
</body>

</html>