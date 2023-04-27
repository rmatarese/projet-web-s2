<?php
session_start();
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="ajout_style.css">
</head>
</html>
<?php
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
    $bar_name = valider_donnees($_POST['bar-name']);
    $bar_city = valider_donnees($_POST['bar-city']); //on valide les données pour éviter les attaques
    $bar_address = valider_donnees($_POST['bar-address']);
    $bar_note = valider_donnees($_POST['Note']);    
    $sql="SELECT Villebar,NomBar FROM bar WHERE NomBar='$bar_name'";
    $resultat =$conn->query($sql);
    $existant=FALSE;
    while($row = mysqli_fetch_assoc($resultat)){ //on vérifie que le bar n'existe pas déjà, en utilisant un booléen comme flag
        if($row['Villebar']==$bar_city){
            echo "<h1>Le bar existe déjà</h1>";
            $existant=TRUE;
        }
    }
    if($existant==FALSE){
    // Créer une requête SQL pour insérer les données du formulaire dans la base de données
    $sql = "INSERT INTO bar (NomBar, AdresseBar, Villebar,Note) VALUES ('$bar_name','$bar_address','$bar_city','$bar_note')";

    // Exécuter la requête SQL
    if (mysqli_query($conn, $sql)) {
        echo "<h1>Les informations du bar ont été enregistrées avec succès. Le bar apparaitra après validation des admins.</h1>";
    } else {
        echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
    }
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
