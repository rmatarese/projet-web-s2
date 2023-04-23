
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
    <p>Bienvenue sur votre page client. Vous pouvez ajouter un bar à notre liste.</p>
    <a href="ajout_bar.php">Ajouter un bar</a>
    <a href="deconnexion.php">Se déconnecter</a>
</body>
</html>
