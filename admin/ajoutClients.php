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
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

</head>




<header>
    <h1>Luna Inc.</h1> 
    <h3>Ajout d'un client</h3>
</header>



<body>
    <main class="boiteGrise">
        <section class="affichage">
            <form action="" method="post">

            <label>Adresse</label>
            <input type="text" name="adresse" value="<?php echo isset($adresse) ? $adresse : "" ?>" required>
            <span><?php echo isset($erreurs['adresse']) ? $erreurs['adresse'] : "&nbsp;"  ?></span><br>

            <label>Telephone</label>
            <input type="text" name="telephone" value="<?php echo isset($telephone) ? $telephone : "" ?>" required>
            <span><?php echo isset($erreurs['telephone']) ? $erreurs['telephone'] : "&nbsp;"  ?></span><br>

            <label>Nom</label>
            <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
            <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span><br>
           
            <input type="submit" name="envoi" value="Envoyer">

                <?php if (isset($_POST["envoi"]))
                    ajouterClient($conn, $_POST);
                ?>
            </form>
        </section>     

<!--     NAVIGATION     -->    
        <?php include "../navigation.php"; ?>        
    </main>
</body>

</html>