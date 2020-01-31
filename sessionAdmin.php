<?php
  
session_start();

if (!isset($_SESSION['utilisateurs_nom']) || (isset($_SESSION['utilisateurs_privilege']) && $_SESSION['utilisateurs_privilege'] != "admin")) {
    // redirection vers la de connexion pour les utilisateurs non connecter
    header('Location: ../index.php'); 
}
?>