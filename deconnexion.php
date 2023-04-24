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
    setcookie('user_id', '', time() - 3600, '/');
    session_destroy();
?>

<html>
    <p> Vous avez bien été déconnecté </p>
    </br>
    <a href='connexion.php'> Retour à la page connexion </a>
    </br>
    <img src='images/logo_alabar.png'>
</html>