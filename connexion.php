



<!DOCTYPE html>
<html>
<head>
  <title>Connexion</title>
  <link rel="stylesheet" type="text/css" href="connexion_style.css">
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
		echo "<p> Bonjour, vous êtes déjà connecté en tant que ".$_SESSION['username'].". </p>";
		echo "<p>Vous pouvez vous déconnecter ou revenir sur la page d'accueil \n</p>";
		echo "<a href='deconnexion.php'>Déconnexion</a>";
		echo "<a href=acceuil.php> Retour acceuil </a>";
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
	$username = valider_donnees($_POST['username']);
	$password = valider_donnees($_POST['password']);

	// Requête pour vérifier les identifiants
	$requete="SELECT Id, password,perm FROM client WHERE Nom = '$username'"; 
	$resultat =$conn->query($requete);
	if ( $resultat == FALSE ){
		echo "<p>Erreur d'exécution de la requete :".mysqli_error($connexion)."</p>" ;
	die();
	}
		
	while($row = mysqli_fetch_assoc($resultat)){
		if ($row["password"] == $password){
			// Stocker les informations de l'utilisateur en session

			$_SESSION["username"]=$_POST['username'];
            $_SESSION["Id"]=$row["Id"];
			$_SESSION["perm"]=$row["perm"];
	  
			// Créer le cookie
			  setcookie('user_id', $_SESSION["Id"], time() + 24*3600*7, '/');
	  
		
			// Rediriger vers la page appropriée
			if ($_SESSION['perm'] == 'admin') {
			  header("Location: page_admin.php");
			} else {
			  header("Location: page_client.php");
			}
			exit();

		}
	 else {
		// Afficher un message d'erreur si les identifiants sont incorrects
		echo " <p> Mot de passe ou nom d'utilisateur incorrect </p>";
		$error = "Nom d'utilisateur ou mot de passe incorrect";
	  }
	}
}
?>

