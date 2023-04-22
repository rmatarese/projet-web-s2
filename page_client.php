session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}
$conn= new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $conn->prepare("SELECT * FROM client WHERE username = :username");
$statement->bindParam(':username', $_SESSION['username']);
