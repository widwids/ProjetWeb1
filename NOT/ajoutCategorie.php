<?php
require_once("../session.php");
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajout d'une categorie</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

</head>




<header>
        <h1>Luna Inc.</h1> 
        <h3>Ajouter une categorie</h3>
</header>



<body>
    <main class="boiteGrise">
        <section class="affichage">
            <form action="" method="post">
                <label>Nom de la categorie</label>
                <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
                <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>
              
            <input type="submit" name="envoi" value="Envoyer">

            <?php if (isset($_POST["envoi"]))
                ajouterCategorie($conn, $_POST);
            ?>
            </form>
        </section>
      

      <!--     NAVIGATION     -->    
              <?php include "../navigation.php"; ?>
          </main>
          <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>
</body>

</html>