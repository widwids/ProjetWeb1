<?php
require_once("../sessionAdmin.php");
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");


$liste = listerUtilisateurs($conn);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

</head>

<header>
<h1><a href="commandes.php">Luna Inc.</a></h1> 
    <h3>Liste des utilisateurs</h3>
</header>






<body>
    <main class="boiteGrise">


    <section class="affichage">
            <form action="" method="post">
            <h3>Ajouter un utilisateur : </h3>
            <label>Identifiant :</label>
            <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
            <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>

            <label>Mot de passe :</label>
            <input type="text" name="mdp" value="<?php echo isset($mdp) ? $mdp : "" ?>" required>
            <span><?php echo isset($erreurs['mdp']) ? $erreurs['mdp'] : "&nbsp;"  ?></span>

            <label>Niveau d'accès :</label>
            <input type="text" name="privilege" value="<?php echo isset($privilege) ? $privilege : "" ?>" required>
            <span><?php echo isset($erreurs['privilege']) ? $erreurs['privilege'] : "&nbsp;"  ?></span>

            
           
            
            <input class="submit" type="submit" name="envoi" value="Enregistrer">

                <?php if (isset($_POST["envoi"]))
                    ajouterUtilisateur($conn, $_POST);
                ?>
            </form>
        </section>
      

      <!--     NAVIGATION     -->    
              <?php include "../navigation.php"; ?>




        <table class="affichage">
            <tr>
                <th>Identifiant</th>
                <th>Mot de passe</th>
                <th>Niveau d'accès</th>


                <th>Action</th>
            </tr>

            <?php foreach ($liste as $row) :
                ?>
                <tr>
                <form action="" method="post">

                    <td><input type="text" name="utilisateurs_nom" value="<?= $row["utilisateurs_nom"] ?>" readonly></td>
                    <td><input type="text" name="utilisateurs_password" value="<?= $row["utilisateurs_password"] ?>" required></td>
                    <td><input type="text" name="utilisateurs_privilege" value="<?= $row["utilisateurs_privilege"] ?>" required></td>
                    
                    <td><input class="submit" type="submit" name="envoiModifier" value="Modifier"></td>
                    <td><input class="submit" type="submit" name="envoiSupprimer" value="Supprimer"></td> 
                </form> 
            </tr>
        <?php
        endforeach; ?>
        </table>
      


          </main>

          <?php if (isset($_POST["envoiModifier"]))
        modifierUtilisateur($conn, $_POST);?>

        <?php if (isset($_POST["envoiSupprimer"]))
        supprimerUtilisateur($conn, $_POST);?>



          <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>


    
    
<!--     <?php if (isset($_POST["envoi"])) : ?>
        <section>
            <p>Confirmez la commande de <?= $_POST['nbCommande'] ?> exemplaire(s) de <?= $_POST['nomProduit'] ?></p>
            <form class="form-suppression" action="" method="post">
                <input type="hidden" name="genre_id" value="<?= $id ?>">
                <input type="submit" name="confirme" value="OUI">
                <input type="submit" name="confirme" value="NON">
            </form>
        </section>
    <?php endif; ?> -->

</body>

</html>    