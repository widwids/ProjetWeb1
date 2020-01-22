<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout d'une categorie</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Ajout d'une categorie</h1>
    <!--     <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
    -->    <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a>
            <a href="index.php">Catalogue Admin</a>
            <a href="listeCommandes.php">Commandes</a>
            <a href="categorie.php">Categories</a>

        </p>
    </header>

    <main>
        <h1>Ajout d'une categorie</h1>

        <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

        <form action="" method="post">

            <label>Nom de la categorie</label>
            <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
            <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>

           
            
        <input type="submit" name="envoi" value="Envoyer">

        <?php if (isset($_POST["envoi"]))
            ajouterCategorie($conn, $_POST);
        ?>

        </form>

    </main>
</body>

</html>