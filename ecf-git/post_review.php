<?php
// Connexion à la base de données avec PDO
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "projet-garage";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Récupération des données du formulaire
  $prenom = $_POST['prenom'];
  $rating = $_POST['rating'];
  $commentaire = $_POST['commentaire'];

  // Insertion de l'avis dans la base de données (non approuvé par défaut)
  $stmt = $conn->prepare("INSERT INTO avis (prenom, rating, commentaire, approuve) VALUES (:prenom, :rating, :commentaire, 0)");
  $stmt->bindParam(':prenom', $prenom);
  $stmt->bindParam(':rating', $rating);
  $stmt->bindParam(':commentaire', $commentaire);
  $stmt->execute();

  // Redirection vers la page d'accueil
  header("Location: index.php");
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
