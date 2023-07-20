<?php
    // Connexion à la base de données avec PDO
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "projet-garage";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Récupération des avis approuvés depuis la base de données
  $stmt = $conn->prepare("SELECT * FROM avis WHERE approuve = 1");
  $stmt->execute();
  $avisApprouves = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Affichage des avis approuvés
  foreach ($avisApprouves as $avis) {
    echo "<div class='avis'>";
        echo "<div class='name-icone'>
                <p class='material-symbols-outlined'>account_circle</p>
                <p class='form-name'><strong>" . $avis['prenom'] . "</strong></p></div>";
        echo "<p class='see-com'> " . $avis['commentaire'] . "</p>";
        echo "<p class='note'>NOTE : " . $avis['rating'] . "/5</p>";
        echo "</div>";
  }
} catch (PDOException $e) {
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
