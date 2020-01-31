<?php
require_once("../session.php");
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

$commande = listerCommandes($conn);
$client = listerClients($conn);
$liste = listerProduits($conn);






/* 


// define how many results you want per page
$results_per_page = 10;

// find out the number of results stored in database
$sql='SELECT * FROM commandes';
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
$sql='SELECT * FROM commandes LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
  echo $row['id'] . ' ' . $row['fk_client_id']. '<br>';
}

// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="commandes.php?page=' . $page . '">' . $page . '</a> ';
}

 */







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
<h1><a href="commandes.php">Luna Inc.</a></h1> 
    <h3>Catalogue des commandes</h3>
</header>






<body>
    <main class="boiteGrise">

        <section class="affichage">
            <form action="" method="post">
            <h3>Ajouter une commande : </h3>

            <label>Date : </label>
            <input type="text" name="date" value="<?php echo isset($date) ? $date : "" ?>" required>
            <span><?php echo isset($erreurs['date']) ? $erreurs['date'] : "&nbsp;"  ?></span>

            <label>Adresse : </label>
            <input type="text" name="adresse" value="<?php echo isset($adresse) ? $adresse : "" ?>" required>
            <span><?php echo isset($erreurs['adresse']) ? $erreurs['adresse'] : "&nbsp;"  ?></span>

            <label>État :</label>
            <input type="text" name="etat" value="<?php echo isset($etat) ? $etat : "" ?>" required>
            <span><?php echo isset($erreurs['etat']) ? $erreurs['etat'] : "&nbsp;"  ?></span>

            <label>Commentaires :</label>
            <input type="text" name="commentaire" value="<?php echo isset($commentaire) ? $commentaire : "" ?>">
            <span><?php echo isset($erreurs['commentaire']) ? $erreurs['commentaire'] : "&nbsp;"  ?></span>




            <table>
                <?php if (count($client) > 0) : ?>

                    <label>Nom du client :</label>
                    <select name="client_id">
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

                <label>Produit :</label>
                <select name="produit_id">
                    <?php foreach ($liste as $row) : ?>
                        <option value="<?= $row["produits_id"] ?>"><?= $row["produits_nom"] ?></option>
                    <?php endforeach; ?>
                </select>
            </table>
                <?php else : ?>
                    <p>Aucun produit trouvé.</p>
                <?php endif; ?>



            <label>Quantité :</label>
            <input type="text" name="quantite" value="<?php echo isset($quantite) ? $quantite : "" ?>">
            <span><?php echo isset($erreurs['quantite']) ? $erreurs['quantite'] : "&nbsp;"  ?></span>


            <input class="submit" type="submit" name="envoi" value="Enregistrer">

            <?php if (isset($_POST["envoi"]))
                enregistrerCommande($conn, $_POST);
            ?>
            </form>

    </section>     

<!--     NAVIGATION     -->    
<?php include "../navigation.php"; ?>


        <table class="affichage">
            <tr>
                <th>Numéro</th>
                <th>Date</th>
                <th>Adresse</th>
                <th>État</th>
                <th>Commentaire</th>
                <th>Nom du client</th>
                <th>Produit</th>
                <th>Quantité</th>


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

                    <td><input class="submit" type="submit" name="envoiModifier" value="Modifier"></td>
                    <td><input class="submit" type="submit" name="envoiSupprimer" value="Supprimer"></td>         
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
