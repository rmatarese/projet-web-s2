<?php
session_start();

// Vérifier si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Se connecter à la base de données MySQL
    require("DB-Link.php");

    $conn = mysqli_connect($servername, $username, $password, $database);

    // Vérifier la connexion
    if (!$conn) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }
    // Récupérer les données du formulaire
    $bar_name = $_POST['bar-name'];
    $bar_city = $_POST['bar-city'];
    $bar_address = $_POST['bar-address'];
    $bar_note = $_POST['Note'];
    $bar_comment = $_POST['Commentaire'];

    // Créer une requête SQL pour insérer les données du formulaire dans la base de données
    $sql = "INSERT INTO bar_temp (NomBar, AdresseBar, Villebar,Note, Commentaires) VALUES ('$bar_name','$bar_address','$bar_city','$bar_note','$bar_comment')";

    // Exécuter la requête SQL
    if (mysqli_query($conn, $sql)) {
        echo "Les informations du bar ont été enregistrées avec succès. la page devrait apparaître sous peu.";
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Fermer la connexion à la base de données
    mysqli_close($conn);

} else {
    header("Location: ajout_bar.php");
}
?>
<DOCTYPE html>
<html>
<a href="page_client.php">Retourner à la page client</a>
</html>
