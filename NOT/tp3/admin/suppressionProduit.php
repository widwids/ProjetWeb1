<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");
require_once("../inc/sessionAdmin.php");

?>

<?php


// retour du formulaire de confirmation
// ------------------------------------

$confirme = isset($_POST['confirme']) ? $_POST['confirme'] : "";

if ($confirme !== "") {

    if ($confirme === "OUI") {
        $id = $_POST['produit_id'];
        $codRet = supprimerProduit($conn, $id);
        if ($codRet === 1)  $message = "Suppression effectuée.";
        elseif ($codRet === 0)  $message = "Aucune supression.";
    } else {
        $message = "Suppression non effectuée.";
    }
} else {

    // lecture du produit à supprimer
    // ----------------------------

    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $row = array();
    if ($id !== "") $row = lireProduit($conn, $id);
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Liste des produits">
    <title>Liste des produits</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>


<body>
    <header>
        <h1>Dashboard Admin -supprimer un produit</h1>
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
        <h1>Suppression d'un produit </h1>

        <p><?php echo isset($message) ? $message : "&nbsp;" ?></p>

        <?php if (isset($row)) : ?>
            <?php if (count($row) > 0) : ?>
                <section>
                    <p>Confirmez la suppression du produit <?php echo $row['produit_nom'] ?></p>
                    <form class="form-suppression" action="suppressionProduit.php" method="post">
                        <input type="hidden" name="produit_id" value="<?php echo $id ?>">
                        <input type="submit" name="confirme" value="OUI">
                        <input type="submit" name="confirme" value="NON">
                    </form>
                </section>
            <?php else : ?>
                <p>Il n'y a pas de Produit pour cet identifiant.</p>
            <?php endif; ?>
        <?php endif; ?>

    </main>
</body>

</html>

</html