



<!DOCTYPE html>
<html>
<head>
  <title>Connexion</title>
  <link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>

  <h1>Connexion</h1>

  <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>



  <?php
	require("DB-Link.php");
	session_start();
?>

  <?php
  // Vérifier si l'utilisateur est déjà connecté

	/* Cas où l'utilisateur est déjà connecté*/
	if (isset($_COOKIE['user_id'])) {
		echo "Bonjour, vous êtes déjà connecté en tant que ".$_SESSION['username'].". ";
		echo "Vous pouvez vous déconnecter ou revenir sur la page d'acceuil \n";
		echo "<a href='deconnexion.php'>Déconnexion</a>";
		echo "<a href=acceuil.php>";
		exit();
	  }
	else {
		?>
	<form method="post">
    <label> Nom d'utilisateur:</label>
    <input type="text" name="username" required>
    <br>
    <label>Mot de passe:</label>
    <input type="password" name="password" required>
	<br>
	<input type="submit" name="login" value="Connexion">
	</form>
	<a href="new_account.php"> Créer un compte </a>

  	<?php } ?>
</body>
</html>

<?php
// Traitement du formulaire de connexion
if (isset($_POST['login'])) {
	// Récupérer les identifiants du formulaire
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Requête pour vérifier les identifiants
	$query = "SELECT * FROM client WHERE Nom = :Nom AND password = :password";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':Nom', $username);
	$stmt->bindParam(':password', $password);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
  
	// Vérifier si les identifiants sont corrects
	if (isset($user)) {
	  // Stocker les informations de l'utilisateur en session

	  $_SESSION['user_id'] = $user['Id'];
	  $_SESSION['username'] = $user['Nom'];
	  $_SESSION['user_type'] = $user['perm'];

	  // Créer le cookie
  	  setcookie('user_id', $user['Id'], time() + 24*3600*7, '/');

  
	  // Rediriger vers la page appropriée
	  if ($user['perm'] == 'admin') {
		header("Location: page_admin.php");
	  } else {
		header("Location: page_client.php");
		echo isset($_SESSION['username']);
	  }
	  exit();
	

	} else {
	  // Afficher un message d'erreur si les identifiants sont incorrects
	  echo "Mot de passe ou nom d'utilisateur incorrect";
	  $error = "Nom d'utilisateur ou mot de passe incorrect";
	}
}
?>

