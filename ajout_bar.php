<?PHP

session_start();

if(!isset($_SESSION['username'])){
    header("Location: connexion.php");
}
?>
<DOCTYPE html>
<html>
<form action="ajout.php" method="POST">
  
  <label for="bar-name">Nom du bar:</label>
  <input type="text" id="bar-name" name="bar-name" required><br><br>
  
  <label for="bar-city">Ville du bar:</label>
  <input type="text" id="bar-city" name="bar-city" required><br><br>
  
  <label for="bar-address">Adresse du bar:</label>
  <input type="text" id="bar-address" name="bar-address" required><br><br>

  <label for="Note">Note:</label>
  <input type="number" id="Note" name="Note" required><br><br>

  <label for="Commentaire">Commentaire:</label>
  <input type="text" id="Commentaire" name="Commentaire"><br><br>

  <input type="submit" value="Envoyer">
</form>
</html>
