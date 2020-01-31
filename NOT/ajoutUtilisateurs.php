<?php
require_once("../session.php");
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

</head>

<header>
    <h1>Luna Inc.</h1> 
    <h3>Ajouter un utilisateur</h3>
</header>





<body>    
    <main class="boiteGrise">
        <section class="affichage">
            <form action="" method="post">

            <label>Identifiant</label>
            <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
            <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span><br>

            <label>Mot de passe</label>
            <input type="text" name="mdp" value="<?php echo isset($mdp) ? $mdp : "" ?>" required>
            <span><?php echo isset($erreurs['mdp']) ? $erreurs['mdp'] : "&nbsp;"  ?></span><br>

            <label>Niveau d'accès</label>
            <input type="text" name="privilege" value="<?php echo isset($privilege) ? $privilege : "" ?>" required>
            <span><?php echo isset($erreurs['privilege']) ? $erreurs['privilege'] : "&nbsp;"  ?></span><br>

            
           
            
            <input type="submit" name="envoi" value="Envoyer">

                <?php if (isset($_POST["envoi"]))
                    ajouterUtilisateur($conn, $_POST);
                ?>
            </form>
        </section>
      

      <!--     NAVIGATION     -->    
              <?php include "../navigation.php"; ?>
          </main>
          <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

</html>