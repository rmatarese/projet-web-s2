<?php 
/* Connexion à la base de donnée de connexion */
$servername ='localhost';
$username ='root';
$password ='root';
$database = 'alabar';

$conn=mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    echo "Erreur de connexion".mysqli_connect_errno();
    die();
}
//on définie la fonction valider données pour éviter les attaques dans ce fichier car elle sera utilisée souvent
function valider_donnees($donnees){
    $donnees=trim($donnees);
    $donnees=stripslashes($donnees);
    $donnees=htmlspecialchars($donnees);
    return $donnees;
}

?>