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
    <title>Ajout d'une commande</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Ajout d'une commande</h1>
    <!--     <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>
    -->    <p class="menu">
            <a href="../deconnexion.php">Déconnexion</a>
            <a href="index.php">Catalogue Admin</a>
            <a href="listeCommandes.php">Commandes</a>
            <a href="categorie.php">Categories</a>
            <a href="clients.php">Catalogue de clients</a>
            <a href="utilisateurs.php">Catalogue des utilisateurs</a>



        </p>
    </header>

    <table>
            <tr>
                <th>Numero de serie</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Catégorie</th>

                <th>Action</th>
            </tr>
            <?php foreach ($liste as $row) :
                ?>
                <tr>
                    <td><?= $row["produits_id"] ?></td>
                    <td><?= $row["produits_nom"] ?></td>
                    <td><?= $row["produits_description"] ?></td>
                    <td><?= $row["produits_prix"] . " $" ?></td>
                    <td><?= $row["produits_quantite"] . "" ?></td>
                    <td><?= $row["fk_categorie_id"] ?></td>
                    <!-- <td> 
                        <a href="modificationProduit.php?id=<?= $row['produit_id'] ?>">Modifier</a>
                        <a href="suppressionProduit.php?id=<?= $row['produit_id'] ?>">Supprimer</a>
                    </td> -->
                    
                </tr>
            <?php
            endforeach; ?>
        </table>


    <main>
        <h1>Ajout d'une commande</h1>

        <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

        <form action="" method="post">

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
            




        <input type="submit" name="envoi" value="Envoyer">

        <?php if (isset($_POST["envoi"]))
            enregistrerCommande($conn, $_POST["produit"], $_POST["nomClient"], $_POST["quantite"]);
        ?>

        </form>

    </main>
</body>

</html>