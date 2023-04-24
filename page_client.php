
<?PHP
session_start();
require("DB-Link.php");
// Vérifier si l'utilisateur est déjà connecté
if(!isset($_SESSION['username'])){
    header("Location: accueil.php");
}
?>
<DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Page client</title>
</head>
<body>
    <h1>Page client</h1>
    <p>Bienvenue sur votre page client.</p>
<?php
// Requête SQL pour récupérer toutes les données de la table "utilisateurs"
$sql = "SELECT * FROM bar";
$resultat = mysqli_query($conn, $sql);

// Vérifier si des données ont été trouvées
if (mysqli_num_rows($resultat) > 0) {
    // Afficher le tableau HTML
    echo "<table>";
    echo "<thead><tr><th>Nom du bar</th><th>Adresse du bar</th><th>Ville</th></th>Note générale</th></th>Commentaire</th></tr></thead>";
    echo "<tbody>";
    // Parcourir chaque ligne de données et les afficher dans une ligne du tableau HTML
    while($ligne = mysqli_fetch_assoc($resultat)) {
        echo "<tr><td>".$ligne["NomBar"]."</td><td>".$ligne["AdresseBar"]."</td><td>".$ligne["VilleBar"]."</td></tr>".$ligne["Note"]."</td><td>".$ligne["Commentaires"]."</td></tr>";
    }
    echo "</tbody></table>";
} else {
    echo "Aucune donnée trouvée.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
    <a href="ajout_bar.php">Ajouter un bar</a>
    <a href="deconnexion.php">Se déconnecter</a>
</body>
</html>
