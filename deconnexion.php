<!DOCTYPE HTML>
<?php
    require("DB-Link.php");
    // Sélection de la table "client"
    $table = 'client';
    $query = "SELECT * FROM $table";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    setcookie('user_id', '', time() - 3600, '/');
    session_destroy();
    echo 'Vous avez bien été déconnecté';
    echo '<a href="connexion.php"> Retour à la page connexion </a>';
?>