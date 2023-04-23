<?php
session_start();

require("DB-Link.php"); // Inclure le fichier de connexion à la DB
// Sélection de la table "client"

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
  // Rediriger vers la page appropriée
  if ($_SESSION['user_type'] == 'admin') {
    header("Location: page_admin.php");
  } else {
    header("Location: page_client.php");
  }
  exit();
}

// Traitement du formulaire d'inscription
if (isset($_POST['register'])) {
  // Récupérer les informations du formulaire
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $prenom = $_POST['prenom'];
  $date = $_POST['date'];
  $email = $_POST['email'];

  // Valider les informations du formulaire
  $errors = array();
  $retry = false;
  if (!preg_match('/^[a-zA-Z0-9]{4,}$/', $username)) {
    $errors[] = "Le nom d'utilisateur fait au moins 4 caractères et ne peut contenir que des caractères alphanumériques";
    $retry=true;
  }
  if (!preg_match('/^[a-zA-Z0-9]{4,}$/', $prenom)) {
    $errors[] = "Le prénom fait au moins 4 caractères et ne peut contenir que des caractères alphanumériques";
    $retry=true;
  }

  
  //vérification de l'unicité du nom d'utilisateurs
  $query = "SELECT COUNT(*) FROM client WHERE Nom = :Nom";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':Nom', $username);
  $stmt->execute();
  $count = $stmt->fetchColumn();

if ($count > 0) {
  // Le nom d'utilisateur existe déjà
  $errors[] = "Le nom d'utilisateur est déjà pris";
}
if (!preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/",$password)) {
    $errors[] = "Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre, et faire minimum 8 caractères";
    $retry=true;
}
if ($password != $confirm_password) {
  $errors[] = "Les mots de passe ne correspondent pas";
  $retry=true;
}

  // Enregistrer l'utilisateur dans la base de données
  if (empty($errors)) {
    // Requête pour ajouter l'utilisateur à la base de données
    $query = "INSERT INTO client (Nom, password, Prenom, DateNaissance, email, perm) VALUES (:Nom, :password, :Prenom, :DateNaissance, :email, 'client')";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':Nom', $username);
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hash);
    $stmt->bindParam(':Prenom',$prenom);
    $stmt->bindParam('DateNaissance',$date);
    $stmt->bindParam('email',$email);
    $stmt->execute();

    // Rediriger vers la page de connexion
    echo "Compte créé avec succès.";
    echo "<a href='connexion.php'> Connectez vous </a>";
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Créer un compte</title>
  <link rel="stylesheet" type="text/css" href="new_account_style.css">
</head>
<body>

  <h1>Créer un compte</h1>

  <?php if (!empty($errors)): ?>
    <div class="error">
      <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post">
    <label>Nom d'utilisateur: (*)</label>
    <input type="text" name="username"  required>
    <br>
    <label>Prénom (*)</label>
    <input type="text" name="prenom" required>
    <br>
    <label>Date de naissance (*)</label>
    <input type="date" name="date" required>
    <br>
    <label>E-mail (*)</label>
    <input type="mail" name="email" required>
    <br>
    <label>Mot de passe: (*)</label>
    <input type="password" name="password" required>
    <br>
    <label>Confirmer le mot de passe: (*)</label>
    <input type="password" name="confirm_password" required>
    <br>
    <input type="submit" name="register" value="Créer un compte">
  </form>

  <p>Déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>

</body>
</html>
