<?php
    // Connexion à la base de données avec PDO
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "projet-garage";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // Récupération des avis non approuvés depuis la base de données
  $stmt = $conn->prepare("SELECT * FROM avis WHERE approuve = 0");
  $stmt->execute();
  $avisNonApprouves = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // Affichage des avis non approuvés
  foreach ($avisNonApprouves as $avis) {
    echo "<div class='avis'>";
    echo "<h3>".$avis['prenom']."</h3>";
    echo "<p>Note : ".$avis['rating']."</p>";
    echo "<p>Commentaire : ".$avis['commentaire']."</p>";
    echo "<form method='POST' action='approve_review.php'>";
    echo "<input type='hidden' name='review_id' value='".$avis['id']."'>";
    echo "<button type='submit'>Approuver</button>";
    echo "</form>";
    echo "</div>";
  }
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
