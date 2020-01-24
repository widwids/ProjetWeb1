<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout d'un client</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Ajout d'un client</h1>
    <!--     <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
    -->    <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a>
            <a href="index.php">Catalogue de produits</a>
            <a href="listeCommandes.php">Commandes</a>
            <a href="categorie.php">Categories</a>
            <a href="clients.php">Catalogue de clients</a>
            <a href="utilisateurs.php">Catalogue des utilisateurs</a>



        </p>
    </header>

    <main>
        <h1>Ajout d'un client</h1>

        <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

        <form action="" method="post">

            <label>Adresse</label>
            <input type="text" name="adresse" value="<?php echo isset($adresse) ? $adresse : "" ?>" required>
            <span><?php echo isset($erreurs['adresse']) ? $erreurs['adresse'] : "&nbsp;"  ?></span>

            <label>Telephone</label>
            <input type="text" name="telephone" value="<?php echo isset($telephone) ? $telephone : "" ?>" required>
            <span><?php echo isset($erreurs['telephone']) ? $erreurs['telephone'] : "&nbsp;"  ?></span>

            <label>Nom</label>
            <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
            <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>

           
            
        <input type="submit" name="envoi" value="Envoyer">

        <?php if (isset($_POST["envoi"]))
            ajouterClient($conn, $_POST);
        ?>

        </form>

    </main>
</body>

</html>