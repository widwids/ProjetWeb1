<?php
require_once("./inc/connectDB.php");
require_once("./inc/sql.php");

// test retour de saisie du formulaire
// -----------------------------------        

if (isset($_POST['envoi'])) {
    
    // contrôles des champs saisis
    // ---------------------------
    
    $erreurs = array();
    

    //-----------------Validation---Nom---------------
    $client_nom = trim($_POST['client_nom']);
    if (!preg_match("/^[a-zA-Z\sàáâäãåèéêëìíîïòóôöõøùúûüÿýñçčšžÀÁÂÄÃÅÈÉÊËÌÍÎÏÒÓÔÖÕØÙÚÛÜŸÝÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $client_nom)) {
        $erreurs['client_nom'] = "Nom incorrect.";
    }

    //-----------------Validation---Prenom---------------
    $client_prenom = trim($_POST['client_prenom']);
    if (!preg_match("/^[a-zA-Z\sàáâäãåèéêëìíîïòóôöõøùúûüÿýñçčšžÀÁÂÄÃÅÈÉÊËÌÍÎÏÒÓÔÖÕØÙÚÛÜŸÝÑßÇŒÆČŠŽ∂ð ,.'-]+$/u", $client_prenom)) {
        $erreurs['client_prenom'] = "prenom incorrect.";
    }

    //-----------------Validation---email---------------
    $client_email = trim($_POST['client_email']);
    if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $client_email)) {
        $erreurs['client_email'] = "email incorrect";
    }

    //-----------------Validation---mot de passe---------------
    $client_mdp = trim($_POST['client_mdp']);
    if (!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $client_mdp)) {
        $erreurs['client_mdp'] = "Le mot de passe doit inclure une Lettre majuscule , miniscule, chiffre et special caractère";
    }

    // insertion dans la table clients si aucune erreur
    // -----------------------------------------------
    
    if (count($erreurs) === 0) {
        if (creationDeCompte($conn, $client_nom, $client_prenom, $client_mdp, $client_email) === 1) {
            $retSQL="Ajout effectué.";    
        } else {
            $retSQL ="Ajout non effectué.";    
        }
        // réinit pour une nouvelle saisie
        $client_nom = ""; 
        $client_prenom = "";
        $client_email = "";
        $client_mdp = "";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Creation d'un compte</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <h1>Creation d'un compte</h1>
        
    <main>
        
        <p><?php echo isset($retSQL) ? $retSQL : "&nbsp;" ?></p>
        
        <form action="creationCompteClient.php" method="post">
            <label>Nom</label>
            <input type="text"   name="client_nom" value="<?php echo isset($client_nom) ? $client_nom : "" ?>" required>
            <span><?php echo isset($erreurs['client_nom']) ? $erreurs['client_nom'] : "&nbsp;"  ?></span>

            <label>Prenom</label>
            <input type="text"   name="client_prenom" value="<?php echo isset($client_prenom) ? $client_prenom : "" ?>" required>
            <span><?php echo isset($erreurs['client_prenom']) ? $erreurs['client_prenom'] : "&nbsp;"  ?></span>

            <label>email</label>
            <input type="text"   name="client_email" value="<?php echo isset($client_email) ? $client_email : "" ?>" required>
            <span><?php echo isset($erreurs['client_email']) ? $erreurs['client_email'] : "&nbsp;"  ?></span>

            <label>Mot de passe</label>
            <input type="text"   name="client_mdp" value="<?php echo isset($client_mdp) ? $client_mdp : "" ?>" required>
            <span><?php echo isset($erreurs['client_mdp']) ? $erreurs['client_mdp'] : "&nbsp;"  ?></span>

            <input type="submit" name="envoi" value="Envoyez"> 

        </form>

    </main>
</body>

</html>

