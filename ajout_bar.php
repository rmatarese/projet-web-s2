<?PHP

session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
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


<form action="look.php" method="POST">
  <label for="bar-id">ID du bar:</label>
  <input type="text" id="bar-id" name="bar-id" required><br><br>
  
  <label for="bar-name">Nom du bar:</label>
  <input type="text" id="bar-name" name="bar-name" required><br><br>
  
  <label for="bar-city">Ville du bar:</label>
  <input type="text" id="bar-city" name="bar-city" required><br><br>
  
  <label for="bar-address">Adresse du bar:</label>
  <input type="text" id="bar-address" name="bar-address" required><br><br>
  
  <input type="submit" value="Rechercher">
</form>


