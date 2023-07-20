<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $content = $_POST['content'];

  // Connexion à la base de données avec PDO
  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = ""; 
  $dbname = "projet-garage"; 

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ajouter l'article à la base de données
    $stmt = $conn->prepare("INSERT INTO services (title, content) VALUES (:title, :content)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->execute();

    header("Location: index.php"); // Redirige vers la page d'accueil
    exit();
  } catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
  }
}
?>

