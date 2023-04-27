<!DOCTYPE HTML>

<html>
<head>
  <title>Déconnexion</title>
  <link rel="stylesheet" type="text/css" href="deconnexion_style.css">
</head>
</html>

<?php
    require("DB-Link.php");
    // Sélection de la table "client"
    $table = 'client';
    $query = "SELECT * FROM $table";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    session_start();
    setcookie('user_id', '', time() - 3600, '/'); //on supprime le cookie 'user_id' qui marque la connexion
    session_destroy(); //et on détruit la session actuelle
?>

<html>
    <p> Vous avez bien été déconnecté </p>
    </br>
    <a href='connexion.php'> Retour à la page connexion </a>
    </br>
    <img src='images/logo_alabar.png'>
</html>