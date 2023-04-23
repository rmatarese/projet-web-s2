<?php 
/* Connexion à la base de donnée de connexion */
$servername ='localhost';
$username ='root';
$password ='root';
$database = 'alabar';

$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>