<?php
  
session_start();

if (!isset($_SESSION['utilisateurs_nom'])) {
    // redirection vers la de connexion pour les utilisateurs non connecter
    header('Location: ../index.php'); 
}
?>