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
    <title>Ajouter une commande</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<header>
        <h1>Luna Inc.</h1> 
        <h3>Ajouter une commande</h3>
    </header>







<body>
    

    


    <main class="boiteGrise">
        <section class="affichage">

            <form action="" method="post">

            <label>Date</label>
            <input type="text" name="date" value="<?php echo isset($date) ? $date : "" ?>" required>
            <span><?php echo isset($erreurs['date']) ? $erreurs['date'] : "&nbsp;"  ?></span><br>

            <label>Adresse </label>
            <input type="text" name="adresse" value="<?php echo isset($adresse) ? $adresse : "" ?>" required>
            <span><?php echo isset($erreurs['adresse']) ? $erreurs['adresse'] : "&nbsp;"  ?></span><br>
           
            <label>Etat</label>
            <input type="text" name="etat" value="<?php echo isset($etat) ? $etat : "" ?>" required>
            <span><?php echo isset($erreurs['etat']) ? $erreurs['etat'] : "&nbsp;"  ?></span><br>

            <label>Commentaires</label>
            <input type="text" name="commentaire" value="<?php echo isset($commentaire) ? $commentaire : "" ?>">
            <span><?php echo isset($erreurs['commentaire']) ? $erreurs['commentaire'] : "&nbsp;"  ?></span><br>




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
            




            <input type="submit" name="envoi" value="Envoyer">

            <?php if (isset($_POST["envoi"]))
                enregistrerCommande($conn, $_POST["produit"], $_POST["nomClient"], $_POST["quantite"]);
            ?>
            </form>



            

            
            
        </section>     

<!--     NAVIGATION     -->    
        <?php include "../navigation.php"; ?>
        </main>
    </body>

</html>