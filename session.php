<?php
  
session_start();

var_dump($_SESSION);

if (!isset($_SESSION['identifiant_utilisateur'])) {
    // redirection vers la de connexion pour les utilisateurs non connecter
    header('Location: ../index.php'); }
?>