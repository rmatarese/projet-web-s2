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
?>