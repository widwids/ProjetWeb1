<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");


$liste = listerClients($conn);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des clients</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

</head>




<header>
<h1><a href="commandes.php">Luna Inc.</a></h1> 
    <h3>Liste des clients</h3>
</header>





<body>
    <main class="boiteGrise">

        <section class="affichage">
                <form action="" method="post">

                <h3>Ajouter un client : </h3>

                <label>Adresse :</label>
                <input type="text" name="adresse" value="<?php echo isset($adresse) ? $adresse : "" ?>" required>
                <span><?php echo isset($erreurs['adresse']) ? $erreurs['adresse'] : "&nbsp;"  ?></span>

                <label>Telephone :</label>
                <input type="text" name="telephone" value="<?php echo isset($telephone) ? $telephone : "" ?>" required>
                <span><?php echo isset($erreurs['telephone']) ? $erreurs['telephone'] : "&nbsp;"  ?></span>

                <label>Nom :</label>
                <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
                <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>
            
                <input class="submit" type="submit" name="envoi" value="Enregistrer">

                    <?php if (isset($_POST["envoi"]))
                        ajouterClient($conn, $_POST);
                    ?>
                </form>
            </section>     

<!--     NAVIGATION     -->    
        <?php include "../navigation.php"; ?>        



        <table class="affichage">
            <tr>
                <th>Numéro de client</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Nom</th>


                <th>Action</th>
            </tr>

            <?php foreach ($liste as $row) :?>
                <tr>
                    <form action="" method="post">

                        <td><input type="text" name="clients_id" value="<?= $row["clients_id"] ?>" readonly></td>
                        <td><input type="text" name="clients_adresse" value="<?= $row["clients_adresse"] ?>" required></td>
                        <td><input type="text" name="clients_telephone" value="<?= $row["clients_telephone"] ?>" required></td>
                        <td><input type="text" name="clients_nom" value="<?= $row["clients_nom"] ?>" required></td>

                        <td><input class="submit" type="submit" name="envoiModifier" value="Modifier"></td>
                        <td><input class="submit" type="submit" name="envoiSupprimer" value="Supprimer"></td>
                    </form>                  
                </tr>
        <?php
        endforeach; ?>
    </table>   

    </main>
    
    <?php if (isset($_POST["envoiModifier"]))
        modifierClient($conn, $_POST);?>

        <?php if (isset($_POST["envoiSupprimer"]))
        supprimerClient($conn, $_POST);?>
        
    




    <!-- <?php if (isset($_POST["envoi"])) : ?>
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