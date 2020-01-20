<?php
require_once("inc/connectDB.php");
require_once("inc/sql.php");
// require_once("inc/sessionUtilisateur.php");
session_start();

unset($_SESSION["message"]);
// Catalogue client
$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : "";

$liste = listerProduits($conn, $recherche);

// retour des formulaires de confirmation
// ------------------------------------
        
$confirme = isset($_POST['confirme']) ? $_POST['confirme'] : "";
$confirmation = isset($_POST['confirmation']) ? $_POST['confirmation'] : "";
if ($confirmation == "OK") {
    echo "test"; 
    header('Location: authentification.php');
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Catalogue produits</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <h1>Catalogue des produits</h1>
    <?php
    if (isset($_SESSION["identifiant_utilisateur"])) : ?>
        <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?><br>
        <h2>Id : <?= $_SESSION['id_utilisateur'] ?></h2>
    <?php endif; ?>
    <p class="menu">
        <a href="deconnexion.php"><?= isset($_SESSION["identifiant_utilisateur"]) ? "Déconnexion" : "Connexion" ?></a>
    </p>
    <form id="recherche" action="" method="get">
        <label>Produit</label>
        <input type="text" name="recherche" value="<?= $recherche ?>" placeholder="nom du produit contient ces caractères">
        <input type="submit" value="Recherchez">
    </form>

    <table>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Marque</th>
            <th>Catégorie</th>
            <th>Commander</th>
        </tr>
        <form id="commande" action="" method="POST">
            <?php foreach ($liste as $row) :
            ?>
                <tr>
                    <td><?= $row["produit_nom"] ?></td>
                    <td><?= $row["produit_description"] ?></td>
                    <td><?= $row["produit_prix"] . " $" ?></td>
                    <td><?= $row["marque_nom"] ?></td>
                    <td><?= $row["categorie_nom"] ?></td>
                    <td style="text-align: center">
                        <input type="number" min="0" max="<?= $row["produit_quantite"] ?>" name="q<?= $row["produit_id"] ?>" placeholder="Quantité">
                    </td>
                </tr> <?php endforeach; ?> </form>
    </table>

    <button form="commande" type="submit" name="envoi">Commandez !</button>

    <?php if (isset($_POST["envoi"])) : ?>
            <?php $i = 1;
            $_SESSION["commande"] = []; ?>
                <?php
                foreach ($_POST as $p => $q) { 
                    if ($q != "" && $q != 0) {
                        $_SESSION["commande"][] = ["produit" => substr($p, 1), "quantité" => $q];
                    }
                    ++$i;
                }
                ?>

    <!-- Tableau récapitulatif de la commande -->
    <?php if (count($_SESSION["commande"]) > 0) : ?>
    <section class="tableau-commande">
        <p>Confirmez la commande :</p>
        <table>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix</th>
            </tr>
            <?php 
            $i = 0;
            foreach ($_SESSION["commande"] as $c) :
            $produit = lireProduit($conn, $c["produit"]);
            ?>
            <tr>
                <td><?= $produit["produit_nom"] ?></td>
                <td><?= $c["quantité"] ?></td>
                <?php $prix[] = $c["quantité"] * $produit["produit_prix"]; ?>
                <td><?= $prix[$i] ?> $</td>
            </tr>
            <?php 
            $i++;
            endforeach; ?>
        </table>
        <p class="total">Total = 
            <?php 
                $total = 0;
                for ($i = 0; $i < count($prix); ++$i) {
                    $total += $prix[$i];
                }
                echo $total . " $";
            ?>
        </p>
    </section>
    <section>
        <form class="form-suppression" action="" method="post"> 
            <input type="submit" name="confirme" value="OUI"> 
            <input type="submit" name="confirme" value="NON">
        </form>
    </section>
    <?php 

    
    // mysqli_commit($conn);
    else : 
        unset($_SESSION["commande"]); ?>
        <p class="erreur">Vous devez selectionner une quantité pour au moins un produit pour passer une commande.</p>
    <?php endif;
    endif; ?>
    <?php
    if ($confirme !== "") {

        if ($confirme === "OUI") {
            if (isset($_SESSION["identifiant_utilisateur"])) {
                enregistrerCommande($conn, $_SESSION["commande"], $_SESSION["id_utilisateur"]);
                $_SESSION["message"] = "<p class=\"succes\">Commande effectuée.</p>";
                unset($_SESSION["commande"]);
            }
            else {
                echo "<p>Vous devez vous connecter ou créer un compte.</p>";
                ?>
                <form class="form-suppression" action="" method="post"> 
                    <input type="submit" name="confirmation" value="OK"> 
                </form>
            <?php 
            }
        }
        else if ($confirme === "NON") {
            $_SESSION["message"] = "<p class=\"erreur\">Commande non effectuée.</p>";
            unset($_SESSION['commande']);
        }
        
     }
    ?>
    <?php echo isset($_SESSION["message"]) ? $_SESSION["message"] : "&nbsp;" ?>
</body>
</html>