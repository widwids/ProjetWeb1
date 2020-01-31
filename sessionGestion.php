<?php
  
session_start();

if (!isset($_SESSION['utilisateurs_nom'])  || (isset($_SESSION['utilisateurs_privilege']) && $_SESSION['utilisateurs_privilege'] == "vendeur")) {
    // redirection vers la de connexion pour les utilisateurs non connecter ou non permis
    header('Location: ../index.php'); 
}
?>