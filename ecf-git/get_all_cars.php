<?php
// Connexion à la base de données avec PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=projet-garage', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

// Requête SQL pour récupérer toutes les voitures
$sql = "SELECT * FROM voitures";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Renvoyer les voitures au format JSON
header('Content-Type: application/json');
echo json_encode($cars);
?>

