<?php

$vendeur = "vendeur";
$gestion = "gestion";
$admin = "admin";

$privilege = "";
if (isset($_SESSION['utilisateurs_privilege'])) {
    $privilege = $_SESSION['utilisateurs_privilege'];
}
?>

<nav>        
    <p class="menu">
        <a href="../index.php?deco=true" class="deconnexion"><br>Déconnexion</a><br>
        <a href="commandes.php" class="button"><br>Commandes</a><br>
        <a href="clients.php" class="button"><br>Clients</a><br>

        <?php if($privilege != $vendeur){ echo '<a href="categorie.php" class="button"><br>Catégories</a><br>'; } ?>
        <?php if($privilege != $vendeur){ echo '<a href="produits.php" class="button"><br>Produits</a><br>'; } ?>

        <?php if($privilege == $admin){ echo '<a href="utilisateurs.php" class="button"><br>Utilisateurs</a><br>';} ?>

    </p>
</nav>



    <!-- <a href="ajout.php" class="button">Ajouter un produit</a><br>
    <a href="ajoutCommande.php" class="button">Ajouter une commande</a><br>
    <a href="ajoutCategorie.php" class="button">Ajouter une categorie</a><br>
    <a href="ajoutClients.php" class="button">Ajouter un client</a><br>
    <a href="ajoutUtilisateurs.php" class="button">Ajouter un utilisateur</a><br>


           
                    <a href="../deconnexion.php">Déconnexion</a><br>
                    <h2>Utilisateur : <?= $_SESSION["identifiant_utilisateur"] ?></h2>

        
        
             <form id="recherche" action="" method="post">
            <label>Produit</label>
            <input type="text" name="recherche" value="<?= $recherche ?>" placeholder="nom du produit contient ces caractères">
            <input type="submit" value="Recherchez">
        </form> -->
