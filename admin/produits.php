<?php
require_once("../sessionGestion.php");
require_once("../inc/connectDB.php");
require_once("../inc/sql.php");

// Catalogue client
$recherche = isset($_POST['recherche']) ? trim($_POST['recherche']) : "";

$liste = listerProduits($conn, $recherche);
$categorie = listerCategories($conn);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue produits</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> 
</head>

<header>
    <h1><a href="commandes.php">Luna Inc.</a></h1> 
    <h3>Catalogue des produits</h3>
</header>





<body>
    <main class="boiteGrise">   
        <section class="affichage">                        
                  
                         <form action="" method="post">

                         <h3>Ajouter un produit : </h3>
                         <label>Nom du produit : </label>
                         <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : "" ?>" required>
                         <span><?php echo isset($erreurs['nom']) ? $erreurs['nom'] : "&nbsp;"  ?></span>
     
                         <label>Description du produit : </label>
                         <input type="text" name="description" value="<?php echo isset($description) ? $description : "" ?>" required>
                         <span><?php echo isset($erreurs['description']) ? $erreurs['description'] : "&nbsp;"  ?></span>
     
                         <label>Prix du produit : </label>
                         <input type="text" name="prix" value="<?php echo isset($prix) ? $prix : "" ?>" required>
                         <span><?php echo isset($erreurs['prix']) ? $erreurs['prix'] : "&nbsp;"  ?></span>
     
                         <label>Quantité du produit : </label>
                         <input type="text" name="quantite" value="<?php echo isset($quantite) ? $quantite : "" ?>" required>
                         <span><?php echo isset($erreurs['quantite']) ? $erreurs['quantite'] : "&nbsp;"  ?></span>
     
                         <table>
                             <?php if (count($categorie) > 0) : ?>
     
                                 <label>Categorie du produit : </label>
                                 <select name="categorie">
                                     <?php foreach ($categorie as $row) : ?>
                                         <option value="<?= $row["categories_id"] ?>"><?= $row["categories_nom"] ?></option>
                                     <?php endforeach; ?>
                                 </select>
                         </table>
                             <?php else : ?>
                                 <p>Aucune categorie trouvé.</p>
                             <?php endif; ?>
     
     
                         <input class="submit" type="submit" name="envoi" value="Enregistrer">
     
                         <?php if (isset($_POST["envoi"]))
                         ajouterProduit($conn, $_POST);
                         ?>
     
                         </form>
                     
                 </section>



        <!--     NAVIGATION     -->    
        <?php include "../navigation.php"; ?>



        <table class="affichage">
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
                    <form action="" method="post">
                    <td><input type="text" name="produits_id" value="<?= $row["produits_id"] ?>" readonly></td>

                    <td><input type="text" name="produits_nom" value="<?= $row["produits_nom"] ?>" required></td>
                    <td><input type="text" name="produits_description" value="<?= $row["produits_description"] ?>" required></td>
                    <td><input type="text" name="produits_prix" value="<?= $row["produits_prix"] ?>" required></td>
                    <td><input type="text" name="produits_quantite" value="<?= $row["produits_quantite"] ?>" required></td>
                    <td>
                        <select name="fk_categorie_id">
                                <?php foreach ($categorie as $rowCategorie) : ?>
                                    <option <?php if($rowCategorie["categories_id"] == $row["fk_categorie_id"]) 
                                    { echo 'selected="selected"'; }?> value="<?= $rowCategorie["categories_id"] ?>"><?= $rowCategorie["categories_nom"] ?></option>
                                <?php endforeach; ?>
                        </select>
                    </td>

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
    <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>

</html>
