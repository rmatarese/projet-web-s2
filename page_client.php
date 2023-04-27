
<?PHP
//On démarre la session
session_start();
//Inclure le fichier de connexion à la base de données
require("DB-Link.php");
// Vérifier si l'utilisateur est déjà connecté
// Si l'utilisateur n'est pas connecté, le rediriger vers la page d'accueil
if(!isset($_SESSION['username'])){
    header("Location: accueil.php");
}
?>
<DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>A la bar</title>
    <link rel="stylesheet" type="text/css" href="page_client_style.css">
</head>
<body>
    <h1>A la bar</h1>

<?php
// Requête SQL pour récupérer toutes les données de la table "bar" où le statut est public
$sql = "SELECT * FROM bar WHERE Status='public'";
//et on exécute
$resultat = mysqli_query($conn, $sql);

// Vérifier si des données ont été trouvées
if (mysqli_num_rows($resultat) > 0) {
    // Afficher le tableau HTML si les données sont trouvées
    echo "<table>";
    echo "<thead><tr><th>Nom du bar</th><th>Adresse du bar</th><th>Ville</th><th>Note</th></tr></thead>";
    echo "<tbody>";
    // Parcourir chaque ligne de données et les afficher dans une ligne du tableau HTML
    while($ligne = mysqli_fetch_assoc($resultat)) {
        echo "<tr><td>".$ligne["NomBar"]."</td><td>".$ligne["AdresseBar"]."</td><td>".$ligne["VilleBar"]."</td><td>".round($ligne["Note"],2)."</td></tr>";
    }
    echo "</tbody></table>";
    //Ajout de lien pour noter un bar présent dans le tableau
    echo'<a href="noter.php"> Noter un bar déjà existant </a>';
} else {
    //Si il n'y a aucun bar dont le statut est public, on affiche un message
    echo "Aucune donnée trouvée.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
    <!--Ajout de lien pour ajouter un bar-->
    <a href="ajout_bar.php">Ajouter un bar</a>
    <!--Ajout de lien pour se déconnecter-->
    <a href="deconnexion.php">Se déconnecter</a>
<?php
    if($_SESSION['perm']=='admin'){//Si l'utilisateur est un administrateur, on affiche un lien vers la page client
        echo '<a href="page_admin.php">Page admin</a>';
    }
?>
</body>
</html>
