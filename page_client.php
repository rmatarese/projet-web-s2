
<?PHP
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$database = "alabar";

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
$conn= new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $conn->prepare("SELECT * FROM client WHERE username = :username");
$statement->bindParam(':username', $_SESSION['username']);

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
