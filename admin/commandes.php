<?php
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

$commande = listerCommandes($conn);
$client = listerClients($conn);
$liste = listerProduits($conn);


?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Commande</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> </head>

</head>
<header>
    <h1>Luna Inc.</h1> 
    <h3>Catalogue des commandes</h3>
</header>






<body>
    <main class="boiteGrise">

        <section class="affichage">
            <form action="" method="post">
            <h3>Ajouter une commande : </h3>

            <label>Date</label>
            <input type="text" name="date" value="<?php echo isset($date) ? $date : "" ?>" required>
            <span><?php echo isset($erreurs['date']) ? $erreurs['date'] : "&nbsp;"  ?></span>

            <label>Adresse </label>
            <input type="text" name="adresse" value="<?php echo isset($adresse) ? $adresse : "" ?>" required>
            <span><?php echo isset($erreurs['adresse']) ? $erreurs['adresse'] : "&nbsp;"  ?></span>

            <label>Etat</label>
            <input type="text" name="etat" value="<?php echo isset($etat) ? $etat : "" ?>" required>
            <span><?php echo isset($erreurs['etat']) ? $erreurs['etat'] : "&nbsp;"  ?></span>

            <label>Commentaires</label>
            <input type="text" name="commentaire" value="<?php echo isset($commentaire) ? $commentaire : "" ?>">
            <span><?php echo isset($erreurs['commentaire']) ? $erreurs['commentaire'] : "&nbsp;"  ?></span>




            <table>
                <?php if (count($client) > 0) : ?>

                    <label>Nom du client</label>
                    <select name="nomClient">
                        <?php foreach ($client as $row) : ?>
                            <option value="<?= $row["clients_id"] ?>"><?= $row["clients_nom"] ?></option>
                        <?php endforeach; ?>
                    </select>
            </table>
                <?php else : ?>
                    <p>Aucun client trouvé.</p>
                <?php endif; ?>





            <table>
            <?php if (count($liste) > 0) : ?>

                <label>Produit</label>
                <select name="produit">
                    <?php foreach ($liste as $row) : ?>
                        <option value="<?= $row["produits_id"] ?>"><?= $row["produits_nom"] ?></option>
                    <?php endforeach; ?>
                </select>
            </table>
                <?php else : ?>
                    <p>Aucun produit trouvé.</p>
                <?php endif; ?>





            <table>    
                <label>Quantité</label>
                <select name="quantite">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                </select> 
            </table>





            <input type="submit" name="envoi" value="Enregistrer">

            <?php if (isset($_POST["envoi"]))
                enregistrerCommande($conn, $_POST);
            ?>
            </form>

    </section>     

<!--     NAVIGATION     -->    
<?php include "../navigation.php"; ?>


        <table class="affichage">
            <tr>
                <th>Numéro de commande</th>
                <th>Date</th>
                <th>Adresse</th>
                <th>État</th>
                <th>Commentaire</th>
                <th>Nom du client</th>
                <th>Produit</th>
                <th>Quantite</th>


                <th>Action</th>
            </tr>
            <?php foreach ($commande as $row) :
                ?>
                <tr>
                <form action="" method="post">

                    <td><input type="text" name="Numéro de commande" value="<?= $row["Numéro de commande"] ?>" readonly></td>
                    <td><input type="text" name="Date" value="<?= $row["Date"] ?>" required></td>
                    <td><input type="text" name="Adresse" value="<?= $row["Adresse"] ?>" required></td>
                    <td><input type="text" name="État" value="<?= $row["État"] ?>" required></td>
                    <td><input type="text" name="Commentaire" value="<?= $row["Commentaire"] . "" ?>" required></td>
                    <td><input type="text" name="Nom du client" value="<?= $row["Nom du client"] ?>" required></td>
                    
                    <td><input type="text" name="Produit" value="<?= $row["Produit"] ?>" required></td>
                    <td><input type="text" name="Quantite" value="<?= $row["Quantite"] ?>" required></td>

                    <td><input type="submit" name="envoiModifier" value="Modifier"></td>
                    <td><input type="submit" name="envoiSupprimer" value="Supprimer"></td>         
                    </form>
                    
                </tr>
            <?php
            endforeach; ?>
        </table>      

    </main>
    
  
    <?php if (isset($_POST["envoiModifier"]))
        modifierProduit($conn, $_POST);?>

        <?php if (isset($_POST["envoiSupprimer"]))
        supprimerProduit($conn, $_POST);?>
        

    <?php if (isset($_POST["envoi"])) : ?>


        <!-- <section>
            <p>Confirmez la commande de <?= $_POST['nbCommande'] ?> exemplaire(s) de <?= $_POST['nomProduit'] ?></p>
            <form class="form-suppression" action="" method="post">
                <input type="hidden" name="genre_id" value="<?= $id ?>">
                <input type="submit" name="confirme" value="OUI">
                <input type="submit" name="confirme" value="NON">
            </form>
        </section> -->

        
    <?php endif; ?>

</body>

</html>
