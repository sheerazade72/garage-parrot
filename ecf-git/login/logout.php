<?php
session_start();

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil
header("Location: ../index.php");
exit();
?>
