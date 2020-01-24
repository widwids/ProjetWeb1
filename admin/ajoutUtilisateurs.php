<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout d'un utilisateur</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Ajout d'un utilisateur</h1>
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
        <h1>Ajout d'un utilisateur</h1>

        <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

        <form action="" method="post">

            <label>Identifiant</label>
            <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
            <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>

            <label>Mot de passe</label>
            <input type="text" name="mdp" value="<?php echo isset($mdp) ? $mdp : "" ?>" required>
            <span><?php echo isset($erreurs['mdp']) ? $erreurs['mdp'] : "&nbsp;"  ?></span>

            <label>Niveau d'accès</label>
            <input type="text" name="privilege" value="<?php echo isset($privilege) ? $privilege : "" ?>" required>
            <span><?php echo isset($erreurs['privilege']) ? $erreurs['privilege'] : "&nbsp;"  ?></span>

            
           
            
        <input type="submit" name="envoi" value="Envoyer">

        <?php if (isset($_POST["envoi"]))
            ajouterUtilisateur($conn, $_POST);
        ?>

        </form>

    </main>
</body>

</html>