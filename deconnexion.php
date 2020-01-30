<?php
session_start();
unset($_SESSION['utilisateurs_nom']); // ou session_unset()
session_destroy();
header('Location: index.php'); 
?>