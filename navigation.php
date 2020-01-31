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

