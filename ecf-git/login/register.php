<?php
// Connexion à la base de données avec PDO
$servername = "localhost";
$dbusername = "root";
$dbpassword = ""; 
$dbname = "projet-garage"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['email'];
        $password = $_POST['password'];

        // Vérifiez si l'utilisateur existe déjà dans la base de données
        $stmt = $conn->prepare("SELECT * FROM workers WHERE email = :email");
        $stmt->bindParam(':email', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // L'utilisateur existe déjà, affiche un message d'erreur
            $error_message = "Nom d'utilisateur déjà utilisé";
        } else {
            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            // Ajoutez l'utilisateur à la base de données
            $stmt = $conn->prepare("INSERT INTO workers (email, password) VALUES (:email, :password)");
            $stmt->bindParam(':email', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            // Redirigez l'utilisateur vers la page home
            header("Location: ../index.php");
            exit();
        }
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
