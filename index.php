<?php
require_once("inc/connectDB.php");
require_once("inc/sql.php");

if (isset($_POST['envoi'])) {

    $utilisateurs_nom = trim(strtolower($_POST['utilisateurs_nom'])); // Trim et met tout les caractères en minuscule
    $utilisateurs_password = trim($_POST['utilisateurs_password']);


    if (controlerUtilisateur($conn, $utilisateurs_nom, $utilisateurs_password) === 1) {
        session_start();
        $_SESSION['utilisateurs_nom'] = $utilisateurs_nom;
        $_SESSION['utilisateurs_privilege'] = lireNomUtilisateur($conn, $utilisateurs_nom);
        // Si l'utilisateur est l'admin, redirige vers le dashboard
        if ($_SESSION['utilisateurs_privilege'] == "admin")


            header('Location: admin/commandes.php');
        // Sinon, redirige vers le catalogue
        else
            header('Location: index.php');
    } else {
        $erreur = "Identifiant ou mot de passe incorrect.";
    }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Authentification</title>
    <link rel="stylesheet" href="../ProjetWeb1/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Play|Roboto&display=swap" rel="stylesheet"> 
</head>

<header>
    <h1><a href="commandes.php">Luna Inc.</a></h1> 
    <h3>Authentification</h3>
</header>

<body>
    <main class="login">   
        <form action="" method="post">
                <p><label>Nom d'utilisateur : 
                        <input type="text" name="utilisateurs_nom" value="" required></label></p>
                <p><label>Mot de passe : 
                        <input type="password" name="utilisateurs_password" value="" required></label></p>
                <input class="submit" type="submit" name="envoi" value="Connexion">
        </form>
    </main>

</body>

</html>