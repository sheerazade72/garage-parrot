<?php
// Connexion à la base de données avec PDO
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "projet-garage";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Vérification du formulaire et récupération de l'ID de l'avis à approuver
  if (isset($_POST['review_id'])) {
    $reviewId = $_POST['review_id'];

    // Mise à jour de la colonne "approuve" pour l'avis spécifié
    $stmt = $conn->prepare("UPDATE avis SET approuve = 1 WHERE id = :review_id");
    $stmt->bindParam(':review_id', $reviewId);
    $stmt->execute();

    // Redirection vers la page d'administration
    header("Location: workers.php");
  } else {
    // Redirection vers la page d'administration avec un message d'erreur
    header("Location: workers.php?error=1");
  }
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
