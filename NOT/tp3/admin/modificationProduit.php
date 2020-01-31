<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");
require_once("../inc/sessionAdmin.php");


$marques = listerMarques($conn);
$cartegories = listerCategories($conn);





if (isset($_POST["envoi"])) {

    $erreurs = array();
    $row['produit_id'] = $_POST['produit_id'];

    //-----------------Validation---Produit---------------
    $row['produit_nom'] = trim($_POST['produit_nom']);
    if (!preg_match("/^[a-zA-Z\sàáâäãåèéêëìíîïòóôöõøùúûüÿýñçčšžÀÁÂÄÃÅÈÉÊËÌÍÎÏÒÓÔÖÕØÙÚÛÜŸÝÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $row['produit_nom'])) {
        $erreurs['produit_nom'] = "produit_nom incorrect.";
    }

    //-----------------Validation---produit_description---------------
    $row['produit_description'] = trim($_POST['produit_description']);
    if (!preg_match("/^[a-zA-Z\sàáâäãåèéêëìíîïòóôöõøùúûüÿýñçčšžÀÁÂÄÃÅÈÉÊËÌÍÎÏÒÓÔÖÕØÙÚÛÜŸÝÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $row['produit_description'])) {
        $erreurs['produit_description'] = "produit_description incorrect";
    }

    //-----------------Validation---produit_prix---------------
    $row['produit_prix'] = trim($_POST['produit_prix']);
    if (!preg_match('/(\d+[.|,]\d{1,2})/', $row['produit_prix'])) {
        $erreurs['produit_prix'] = "produit_prix incorrect.";
    }

    //-----------------Validation---produit_quantite---------------
    $row['produit_quantite'] = trim($_POST['produit_quantite']);
    if (!preg_match('/^[0-9]*$/', $row['produit_quantite'])) {
        $erreurs['produit_quantite'] = "prix incorrect.";
    }

    $row['produit_marque_id'] = $_POST['produit_marque_id'];

    $row['produit_categorie_id'] = $_POST['produit_categorie_id'];



    if (count($erreurs) === 0) {
        if (modifierProduit($conn, $row) === 1) {
            $retSQL = "Modification effectuée.";
            header('Location: index.php');
        } else {
            $retSQL = "Modification non effectuée.";
        }
    }
} else {
    // lecture du produit à modifier, à la première ouverture de la page
    // ---------------------------------------------------------------

    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $row = array();
    if ($id !== "") $row = lireProduit($conn, $id);
}


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
        <h1>Dashboard Admin - Modification d'un produit</h1>
        <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a>
            <a href="index.php">Catalogue admin</a>
            <a href="ajout.php">Ajouter</a>
            <a href="listeCommandes.php">Commandes</a>
            <a href="statistiquesVentes.php">Statistiques de ventes</a>
            <a href="meilleurClient.php">Top 10 des meilleurs clients</a>
        </p>

    </header>
    <main>
        <h1>Modification d'un produit</h1>

        <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

        <form action="modificationProduit.php" method="post">
            <label>Nom du id</label>
            <input type="text" name="produit_id" value="<?= $row['produit_id'] ?>" required>
            <span><?php echo isset($erreurs['produit_id']) ? $erreurs['produit_id'] : "&nbsp;"  ?></span>

            <label>Nom du produit</label>
            <input type="text" name="produit_nom" value="<?= $row['produit_nom'] ?>" required>
            <span><?php echo isset($erreurs['produit_nom']) ? $erreurs['produit_nom'] : "&nbsp;"  ?></span>

            <label>Description du produit </label>
            <input type="text" name="produit_description" value="<?= $row['produit_description'] ?>" required>
            <span><?php echo isset($erreurs['produit_description']) ? $erreurs['produit_description'] : "&nbsp;"  ?></span>

            <label>Prix du produit</label>
            <input type="text" name="produit_prix" value="<?= $row['produit_prix'] ?>" required>
            <span><?php echo isset($erreurs['produit_prix']) ? $erreurs['produit_prix'] : "&nbsp;"  ?></span>

            <label>Quantité du produit</label>
            <input type="text" name="produit_quantite" value="<?= $row['produit_quantite'] ?>" required>
            <span><?php echo isset($erreurs['produit_quantite']) ? $erreurs['produit_quantite'] : "&nbsp;"  ?></span>


            <?php if (count($cartegories) > 0) : ?>
                <table>
                    <label>Categorie du produit</label>
                    <select name="produit_categorie_id">
                        <?php foreach ($cartegories as $categorie) : ?>
                            <option value="<?= $categorie["categorie_id"] ?>"><?= $categorie["categorie_nom"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </table>
            <?php else : ?>
                <p>Aucune categorie trouvé.</p>
            <?php endif; ?>


            <?php if (count($marques) > 0) : ?>
                <table>
                    <label>Categorie du produit</label>
                    <select name="produit_marque_id">
                        <?php foreach ($marques as $marque) : ?>
                            <option value="<?= $marque["marque_id"] ?>"><?= $marque["marque_nom"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </table>
            <?php else : ?>
                <p>Aucune categorie trouvé.</p>
            <?php endif; ?>



            <input type="hidden" name="produit_id" value="<?php echo $row["produit_id"] ?>">
            <input type="submit" name="envoi" value="Envoyez">
        </form>
    </main>
</body>

</html>